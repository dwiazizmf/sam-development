<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyRumahGedungRequest;
use App\Http\Requests\UpdatePolicyRumahGedungRequest;
use App\Http\Resources\Admin\PolicyRumahGedungResource;
use App\Models\PolicyRumahGedung;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyRumahGedungApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_rumah_gedung_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyRumahGedungResource(PolicyRumahGedung::with(['id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyRumahGedungRequest $request)
    {
        $policyRumahGedung = PolicyRumahGedung::create($request->all());

        foreach ($request->input('upload_dokumen', []) as $file) {
            $policyRumahGedung->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
        }

        return (new PolicyRumahGedungResource($policyRumahGedung))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyRumahGedungResource($policyRumahGedung->load(['id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyRumahGedungRequest $request, PolicyRumahGedung $policyRumahGedung)
    {
        $policyRumahGedung->update($request->all());

        if (count($policyRumahGedung->upload_dokumen) > 0) {
            foreach ($policyRumahGedung->upload_dokumen as $media) {
                if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyRumahGedung->upload_dokumen->pluck('file_name')->toArray();
        foreach ($request->input('upload_dokumen', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyRumahGedung->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }
        }

        return (new PolicyRumahGedungResource($policyRumahGedung))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyRumahGedung->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
