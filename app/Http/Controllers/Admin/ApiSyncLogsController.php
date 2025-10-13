<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyApiSyncLogRequest;
use App\Http\Requests\StoreApiSyncLogRequest;
use App\Http\Requests\UpdateApiSyncLogRequest;
use App\Models\ApiSyncLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ApiSyncLogsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('api_sync_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ApiSyncLog::query()->select(sprintf('%s.*', (new ApiSyncLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'api_sync_log_show';
                $editGate      = 'api_sync_log_edit';
                $deleteGate    = 'api_sync_log_delete';
                $crudRoutePart = 'api-sync-logs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('system_name', function ($row) {
                return $row->system_name ? $row->system_name : '';
            });
            $table->editColumn('endpoint', function ($row) {
                return $row->endpoint ? $row->endpoint : '';
            });
            $table->editColumn('request_data', function ($row) {
                return $row->request_data ? $row->request_data : '';
            });
            $table->editColumn('response_data', function ($row) {
                return $row->response_data ? $row->response_data : '';
            });
            $table->editColumn('response_code', function ($row) {
                return $row->response_code ? $row->response_code : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ApiSyncLog::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('error_message', function ($row) {
                return $row->error_message ? $row->error_message : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.apiSyncLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('api_sync_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.apiSyncLogs.create');
    }

    public function store(StoreApiSyncLogRequest $request)
    {
        $apiSyncLog = ApiSyncLog::create($request->all());

        return redirect()->route('admin.api-sync-logs.index');
    }

    public function edit(ApiSyncLog $apiSyncLog)
    {
        abort_if(Gate::denies('api_sync_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.apiSyncLogs.edit', compact('apiSyncLog'));
    }

    public function update(UpdateApiSyncLogRequest $request, ApiSyncLog $apiSyncLog)
    {
        $apiSyncLog->update($request->all());

        return redirect()->route('admin.api-sync-logs.index');
    }

    public function show(ApiSyncLog $apiSyncLog)
    {
        abort_if(Gate::denies('api_sync_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.apiSyncLogs.show', compact('apiSyncLog'));
    }

    public function destroy(ApiSyncLog $apiSyncLog)
    {
        abort_if(Gate::denies('api_sync_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $apiSyncLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyApiSyncLogRequest $request)
    {
        $apiSyncLogs = ApiSyncLog::find(request('ids'));

        foreach ($apiSyncLogs as $apiSyncLog) {
            $apiSyncLog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
