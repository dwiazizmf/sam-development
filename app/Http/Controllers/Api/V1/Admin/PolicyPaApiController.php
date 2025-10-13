<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyPaRequest;
use App\Http\Requests\UpdatePolicyPaRequest;
use App\Http\Resources\Admin\PolicyPaResource;
use App\Models\PolicyPa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyPaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_pa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyPaResource(PolicyPa::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyPaRequest $request)
    {
        $policyPa = PolicyPa::create($request->all());

        foreach ($request->input('upload_dokumen', []) as $file) {
            $policyPa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
        }

        return (new PolicyPaResource($policyPa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyPa $policyPa)
    {
        abort_if(Gate::denies('policy_pa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyPaResource($policyPa->load(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyPaRequest $request, PolicyPa $policyPa)
    {
        $policyPa->update($request->all());

        if (count($policyPa->upload_dokumen) > 0) {
            foreach ($policyPa->upload_dokumen as $media) {
                if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyPa->upload_dokumen->pluck('file_name')->toArray();
        foreach ($request->input('upload_dokumen', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyPa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }
        }

        return (new PolicyPaResource($policyPa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyPa $policyPa)
    {
        abort_if(Gate::denies('policy_pa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyPa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
