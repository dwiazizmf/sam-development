@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.apiSyncLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.api-sync-logs.update", [$apiSyncLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="system_name">{{ trans('cruds.apiSyncLog.fields.system_name') }}</label>
                <input class="form-control {{ $errors->has('system_name') ? 'is-invalid' : '' }}" type="text" name="system_name" id="system_name" value="{{ old('system_name', $apiSyncLog->system_name) }}">
                @if($errors->has('system_name'))
                    <span class="text-danger">{{ $errors->first('system_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.system_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endpoint">{{ trans('cruds.apiSyncLog.fields.endpoint') }}</label>
                <input class="form-control {{ $errors->has('endpoint') ? 'is-invalid' : '' }}" type="text" name="endpoint" id="endpoint" value="{{ old('endpoint', $apiSyncLog->endpoint) }}">
                @if($errors->has('endpoint'))
                    <span class="text-danger">{{ $errors->first('endpoint') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.endpoint_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="request_data">{{ trans('cruds.apiSyncLog.fields.request_data') }}</label>
                <textarea class="form-control {{ $errors->has('request_data') ? 'is-invalid' : '' }}" name="request_data" id="request_data">{{ old('request_data', $apiSyncLog->request_data) }}</textarea>
                @if($errors->has('request_data'))
                    <span class="text-danger">{{ $errors->first('request_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.request_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_data">{{ trans('cruds.apiSyncLog.fields.response_data') }}</label>
                <textarea class="form-control {{ $errors->has('response_data') ? 'is-invalid' : '' }}" name="response_data" id="response_data">{{ old('response_data', $apiSyncLog->response_data) }}</textarea>
                @if($errors->has('response_data'))
                    <span class="text-danger">{{ $errors->first('response_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.response_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_code">{{ trans('cruds.apiSyncLog.fields.response_code') }}</label>
                <input class="form-control {{ $errors->has('response_code') ? 'is-invalid' : '' }}" type="text" name="response_code" id="response_code" value="{{ old('response_code', $apiSyncLog->response_code) }}">
                @if($errors->has('response_code'))
                    <span class="text-danger">{{ $errors->first('response_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.response_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.apiSyncLog.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ApiSyncLog::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $apiSyncLog->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="error_message">{{ trans('cruds.apiSyncLog.fields.error_message') }}</label>
                <textarea class="form-control {{ $errors->has('error_message') ? 'is-invalid' : '' }}" name="error_message" id="error_message">{{ old('error_message', $apiSyncLog->error_message) }}</textarea>
                @if($errors->has('error_message'))
                    <span class="text-danger">{{ $errors->first('error_message') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.apiSyncLog.fields.error_message_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection