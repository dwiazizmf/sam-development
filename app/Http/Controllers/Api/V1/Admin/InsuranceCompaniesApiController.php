<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInsuranceCompanyRequest;
use App\Http\Requests\UpdateInsuranceCompanyRequest;
use App\Http\Resources\Admin\InsuranceCompanyResource;
use App\Models\InsuranceCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsuranceCompaniesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('insurance_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceCompanyResource(InsuranceCompany::all());
    }

    public function store(StoreInsuranceCompanyRequest $request)
    {
        $insuranceCompany = InsuranceCompany::create($request->all());

        if ($request->input('logo', false)) {
            $insuranceCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new InsuranceCompanyResource($insuranceCompany))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
        abort_if(Gate::denies('insurance_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceCompanyResource($insuranceCompany);
    }

    public function update(UpdateInsuranceCompanyRequest $request, InsuranceCompany $insuranceCompany)
    {
        $insuranceCompany->update($request->all());

        if ($request->input('logo', false)) {
            if (! $insuranceCompany->logo || $request->input('logo') !== $insuranceCompany->logo->file_name) {
                if ($insuranceCompany->logo) {
                    $insuranceCompany->logo->delete();
                }
                $insuranceCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($insuranceCompany->logo) {
            $insuranceCompany->logo->delete();
        }

        return (new InsuranceCompanyResource($insuranceCompany))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InsuranceCompany $insuranceCompany)
    {
        abort_if(Gate::denies('insurance_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceCompany->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
