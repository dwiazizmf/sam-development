<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInsuranceProductRequest;
use App\Http\Requests\UpdateInsuranceProductRequest;
use App\Http\Resources\Admin\InsuranceProductResource;
use App\Models\InsuranceProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsuranceProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('insurance_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceProductResource(InsuranceProduct::with(['insurance_company', 'product_type'])->get());
    }

    public function store(StoreInsuranceProductRequest $request)
    {
        $insuranceProduct = InsuranceProduct::create($request->all());

        if ($request->input('wording_product_doc', false)) {
            $insuranceProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('wording_product_doc'))))->toMediaCollection('wording_product_doc');
        }

        return (new InsuranceProductResource($insuranceProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InsuranceProduct $insuranceProduct)
    {
        abort_if(Gate::denies('insurance_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceProductResource($insuranceProduct->load(['insurance_company', 'product_type']));
    }

    public function update(UpdateInsuranceProductRequest $request, InsuranceProduct $insuranceProduct)
    {
        $insuranceProduct->update($request->all());

        if ($request->input('wording_product_doc', false)) {
            if (! $insuranceProduct->wording_product_doc || $request->input('wording_product_doc') !== $insuranceProduct->wording_product_doc->file_name) {
                if ($insuranceProduct->wording_product_doc) {
                    $insuranceProduct->wording_product_doc->delete();
                }
                $insuranceProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('wording_product_doc'))))->toMediaCollection('wording_product_doc');
            }
        } elseif ($insuranceProduct->wording_product_doc) {
            $insuranceProduct->wording_product_doc->delete();
        }

        return (new InsuranceProductResource($insuranceProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InsuranceProduct $insuranceProduct)
    {
        abort_if(Gate::denies('insurance_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
