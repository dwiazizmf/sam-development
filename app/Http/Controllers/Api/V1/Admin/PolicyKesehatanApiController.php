<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyKesehatanRequest;
use App\Http\Requests\UpdatePolicyKesehatanRequest;
use App\Http\Resources\Admin\PolicyKesehatanResource;
use App\Models\PolicyKesehatan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyKesehatanApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_kesehatan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyKesehatanResource(PolicyKesehatan::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyKesehatanRequest $request)
    {
        $policyKesehatan = PolicyKesehatan::create($request->all());

        foreach ($request->input('upload_dokumen', []) as $file) {
            $policyKesehatan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
        }

        return (new PolicyKesehatanResource($policyKesehatan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyKesehatan $policyKesehatan)
    {
        abort_if(Gate::denies('policy_kesehatan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyKesehatanResource($policyKesehatan->load(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyKesehatanRequest $request, PolicyKesehatan $policyKesehatan)
    {
        $policyKesehatan->update($request->all());

        if (count($policyKesehatan->upload_dokumen) > 0) {
            foreach ($policyKesehatan->upload_dokumen as $media) {
                if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyKesehatan->upload_dokumen->pluck('file_name')->toArray();
        foreach ($request->input('upload_dokumen', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyKesehatan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }
        }

        return (new PolicyKesehatanResource($policyKesehatan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyKesehatan $policyKesehatan)
    {
        abort_if(Gate::denies('policy_kesehatan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyKesehatan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
