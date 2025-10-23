<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
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

    public function show(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PoliciesCentralResource($policiesCentral->load(['assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by']));
    }
}
