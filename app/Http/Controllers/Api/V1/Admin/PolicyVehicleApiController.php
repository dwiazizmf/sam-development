<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyVehicleRequest;
use App\Http\Requests\UpdatePolicyVehicleRequest;
use App\Http\Resources\Admin\PolicyVehicleResource;
use App\Models\PolicyVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyVehicleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyVehicleResource(PolicyVehicle::with(['id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyVehicleRequest $request)
    {
        $policyVehicle = PolicyVehicle::create($request->all());

        foreach ($request->input('upload_kendaraan', []) as $file) {
            $policyVehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
        }

        return (new PolicyVehicleResource($policyVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyVehicle $policyVehicle)
    {
        abort_if(Gate::denies('policy_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyVehicleResource($policyVehicle->load(['id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyVehicleRequest $request, PolicyVehicle $policyVehicle)
    {
        $policyVehicle->update($request->all());

        if (count($policyVehicle->upload_kendaraan) > 0) {
            foreach ($policyVehicle->upload_kendaraan as $media) {
                if (! in_array($media->file_name, $request->input('upload_kendaraan', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyVehicle->upload_kendaraan->pluck('file_name')->toArray();
        foreach ($request->input('upload_kendaraan', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyVehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
            }
        }

        return (new PolicyVehicleResource($policyVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyVehicle $policyVehicle)
    {
        abort_if(Gate::denies('policy_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyVehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
