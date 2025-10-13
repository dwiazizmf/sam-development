<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClaimTypeGroupRequest;
use App\Http\Requests\UpdateClaimTypeGroupRequest;
use App\Http\Resources\Admin\ClaimTypeGroupResource;
use App\Models\ClaimTypeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClaimTypeGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('claim_type_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimTypeGroupResource(ClaimTypeGroup::all());
    }

    public function store(StoreClaimTypeGroupRequest $request)
    {
        $claimTypeGroup = ClaimTypeGroup::create($request->all());

        return (new ClaimTypeGroupResource($claimTypeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClaimTypeGroup $claimTypeGroup)
    {
        abort_if(Gate::denies('claim_type_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimTypeGroupResource($claimTypeGroup);
    }

    public function update(UpdateClaimTypeGroupRequest $request, ClaimTypeGroup $claimTypeGroup)
    {
        $claimTypeGroup->update($request->all());

        return (new ClaimTypeGroupResource($claimTypeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClaimTypeGroup $claimTypeGroup)
    {
        abort_if(Gate::denies('claim_type_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimTypeGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
