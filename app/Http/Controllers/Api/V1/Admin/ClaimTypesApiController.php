<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClaimTypeRequest;
use App\Http\Requests\UpdateClaimTypeRequest;
use App\Http\Resources\Admin\ClaimTypeResource;
use App\Models\ClaimType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClaimTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('claim_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimTypeResource(ClaimType::with(['claim_gorup'])->get());
    }

    public function store(StoreClaimTypeRequest $request)
    {
        $claimType = ClaimType::create($request->all());

        return (new ClaimTypeResource($claimType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClaimType $claimType)
    {
        abort_if(Gate::denies('claim_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimTypeResource($claimType->load(['claim_gorup']));
    }

    public function update(UpdateClaimTypeRequest $request, ClaimType $claimType)
    {
        $claimType->update($request->all());

        return (new ClaimTypeResource($claimType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClaimType $claimType)
    {
        abort_if(Gate::denies('claim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
