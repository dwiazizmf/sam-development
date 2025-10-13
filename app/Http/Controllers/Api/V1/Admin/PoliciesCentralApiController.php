<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePoliciesCentralRequest;
use App\Http\Requests\UpdatePoliciesCentralRequest;
use App\Http\Resources\Admin\PoliciesCentralResource;
use App\Models\PoliciesCentral;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PoliciesCentralApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('policies_central_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PoliciesCentralResource(PoliciesCentral::with(['assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by'])->get());
    }

    public function store(StorePoliciesCentralRequest $request)
    {
        $policiesCentral = PoliciesCentral::create($request->all());

        foreach ($request->input('external_polis_doc', []) as $file) {
            $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
        }

        return (new PoliciesCentralResource($policiesCentral))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PoliciesCentralResource($policiesCentral->load(['assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by']));
    }

    public function update(UpdatePoliciesCentralRequest $request, PoliciesCentral $policiesCentral)
    {
        $policiesCentral->update($request->all());

        if (count($policiesCentral->external_polis_doc) > 0) {
            foreach ($policiesCentral->external_polis_doc as $media) {
                if (! in_array($media->file_name, $request->input('external_polis_doc', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policiesCentral->external_polis_doc->pluck('file_name')->toArray();
        foreach ($request->input('external_polis_doc', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
            }
        }

        return (new PoliciesCentralResource($policiesCentral))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policiesCentral->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
