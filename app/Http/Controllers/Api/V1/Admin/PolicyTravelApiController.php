<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePolicyTravelRequest;
use App\Http\Requests\UpdatePolicyTravelRequest;
use App\Http\Resources\Admin\PolicyTravelResource;
use App\Models\PolicyTravel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyTravelApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policy_travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyTravelResource(PolicyTravel::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->get());
    }

    public function store(StorePolicyTravelRequest $request)
    {
        $policyTravel = PolicyTravel::create($request->all());

        foreach ($request->input('upload', []) as $file) {
            $policyTravel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload');
        }

        return (new PolicyTravelResource($policyTravel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyTravelResource($policyTravel->load(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by']));
    }

    public function update(UpdatePolicyTravelRequest $request, PolicyTravel $policyTravel)
    {
        $policyTravel->update($request->all());

        if (count($policyTravel->upload) > 0) {
            foreach ($policyTravel->upload as $media) {
                if (! in_array($media->file_name, $request->input('upload', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyTravel->upload->pluck('file_name')->toArray();
        foreach ($request->input('upload', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyTravel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload');
            }
        }

        return (new PolicyTravelResource($policyTravel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyTravel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
