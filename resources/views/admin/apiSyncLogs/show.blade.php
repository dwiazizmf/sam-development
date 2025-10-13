@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.apiSyncLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.api-sync-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.id') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.system_name') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->system_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.endpoint') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->endpoint }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.request_data') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->request_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.response_data') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->response_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.response_code') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->response_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ApiSyncLog::STATUS_SELECT[$apiSyncLog->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.apiSyncLog.fields.error_message') }}
                        </th>
                        <td>
                            {{ $apiSyncLog->error_message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.api-sync-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection