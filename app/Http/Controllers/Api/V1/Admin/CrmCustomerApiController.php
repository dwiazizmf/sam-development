<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Http\Resources\Admin\CrmCustomerResource;
use App\Models\CrmCustomer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrmCustomerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrmCustomerResource(CrmCustomer::with(['role', 'status', 'assigned_to_user', 'prospects_source', 'created_by'])->get());
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        foreach ($request->input('dokumen_legalitas', []) as $file) {
            $crmCustomer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('dokumen_legalitas');
        }

        return (new CrmCustomerResource($crmCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrmCustomerResource($crmCustomer->load(['role', 'status', 'assigned_to_user', 'prospects_source', 'created_by']));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $crmCustomer->update($request->all());

        if (count($crmCustomer->dokumen_legalitas) > 0) {
            foreach ($crmCustomer->dokumen_legalitas as $media) {
                if (! in_array($media->file_name, $request->input('dokumen_legalitas', []))) {
                    $media->delete();
                }
            }
        }
        $media = $crmCustomer->dokumen_legalitas->pluck('file_name')->toArray();
        foreach ($request->input('dokumen_legalitas', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $crmCustomer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('dokumen_legalitas');
            }
        }

        return (new CrmCustomerResource($crmCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
