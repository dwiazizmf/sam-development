@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.claimTypeGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.claim-type-groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="claim_group_code">{{ trans('cruds.claimTypeGroup.fields.claim_group_code') }}</label>
                <input class="form-control {{ $errors->has('claim_group_code') ? 'is-invalid' : '' }}" type="text" name="claim_group_code" id="claim_group_code" value="{{ old('claim_group_code', '') }}">
                @if($errors->has('claim_group_code'))
                    <span class="text-danger">{{ $errors->first('claim_group_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimTypeGroup.fields.claim_group_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="claim_group_name">{{ trans('cruds.claimTypeGroup.fields.claim_group_name') }}</label>
                <input class="form-control {{ $errors->has('claim_group_name') ? 'is-invalid' : '' }}" type="text" name="claim_group_name" id="claim_group_name" value="{{ old('claim_group_name', '') }}" required>
                @if($errors->has('claim_group_name'))
                    <span class="text-danger">{{ $errors->first('claim_group_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimTypeGroup.fields.claim_group_name_helper') }}</span>
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