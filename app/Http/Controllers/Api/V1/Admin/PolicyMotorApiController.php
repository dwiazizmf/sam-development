<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyMotorRequest;
use App\Http\Requests\UpdatePolicyMotorRequest;
use App\Http\Resources\Admin\PolicyMotorResource;
use App\Models\PolicyMotor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyMotorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_motor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyMotorResource(PolicyMotor::with(['id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyMotorRequest $request)
    {
        $policyMotor = PolicyMotor::create($request->all());

        foreach ($request->input('upload_kendaraan', []) as $file) {
            $policyMotor->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
        }

        return (new PolicyMotorResource($policyMotor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyMotorResource($policyMotor->load(['id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyMotorRequest $request, PolicyMotor $policyMotor)
    {
        $policyMotor->update($request->all());

        if (count($policyMotor->upload_kendaraan) > 0) {
            foreach ($policyMotor->upload_kendaraan as $media) {
                if (! in_array($media->file_name, $request->input('upload_kendaraan', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyMotor->upload_kendaraan->pluck('file_name')->toArray();
        foreach ($request->input('upload_kendaraan', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyMotor->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
            }
        }

        return (new PolicyMotorResource($policyMotor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyMotor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
