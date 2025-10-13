<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiSyncLogRequest;
use App\Http\Requests\UpdateApiSyncLogRequest;
use App\Http\Resources\Admin\ApiSyncLogResource;
use App\Models\ApiSyncLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSyncLogsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('api_sync_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApiSyncLogResource(ApiSyncLog::all());
    }

    public function store(StoreApiSyncLogRequest $request)
    {
        $apiSyncLog = ApiSyncLog::create($request->all());

        return (new ApiSyncLogResource($apiSyncLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ApiSyncLog $apiSyncLog)
    {
        abort_if(Gate::denies('api_sync_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApiSyncLogResource($apiSyncLog);
    }

    public function update(UpdateApiSyncLogRequest $request, ApiSyncLog $apiSyncLog)
    {
        $apiSyncLog->update($request->all());

        return (new ApiSyncLogResource($apiSyncLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ApiSyncLog $apiSyncLog)
    {
        abort_if(Gate::denies('api_sync_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $apiSyncLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
