@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.claimType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.claim-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="claim_gorup_id">{{ trans('cruds.claimType.fields.claim_gorup') }}</label>
                <select class="form-control select2 {{ $errors->has('claim_gorup') ? 'is-invalid' : '' }}" name="claim_gorup_id" id="claim_gorup_id" required>
                    @foreach($claim_gorups as $id => $entry)
                        <option value="{{ $id }}" {{ old('claim_gorup_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_gorup'))
                    <span class="text-danger">{{ $errors->first('claim_gorup') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.claim_gorup_helper') }}</span>
            </div>

            {{--<div class="form-group">
                <label for="claim_type_code">{{ trans('cruds.claimType.fields.claim_type_code') }}</label>
                <input class="form-control {{ $errors->has('claim_type_code') ? 'is-invalid' : '' }}" type="text" name="claim_type_code" id="claim_type_code" value="{{ old('claim_type_code', '') }}">
                @if($errors->has('claim_type_code'))
                    <span class="text-danger">{{ $errors->first('claim_type_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.claim_type_code_helper') }}</span>
            </div>--}}

            <div class="form-group">
                <label class="required">{{ trans('Coverage Claim') }}</label>
                <select class="form-control {{ $errors->has('claim_type_code') ? 'is-invalid' : '' }}" name="claim_type_code" id="claim_type_code" required>
                    <option value disabled {{ old('claim_type_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ClaimType::CLAIM_COVERAGE as $key => $label)
                        <option value="{{ $key }}" {{ old('claim_type_code', 'pa') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_type_code'))
                    <span class="text-danger">{{ $errors->first('claim_type_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.claim_type_code_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="claim_type_name">{{ trans('cruds.claimType.fields.claim_type_name') }}</label>
                <input class="form-control {{ $errors->has('claim_type_name') ? 'is-invalid' : '' }}" type="text" name="claim_type_name" id="claim_type_name" value="{{ old('claim_type_name', '') }}" required>
                @if($errors->has('claim_type_name'))
                    <span class="text-danger">{{ $errors->first('claim_type_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.claim_type_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.claimType.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_claim_amount">{{ trans('cruds.claimType.fields.max_claim_amount') }}</label>
                <input class="form-control {{ $errors->has('max_claim_amount') ? 'is-invalid' : '' }}" type="number" name="max_claim_amount" id="max_claim_amount" value="{{ old('max_claim_amount', '0') }}" step="0.01">
                @if($errors->has('max_claim_amount'))
                    <span class="text-danger">{{ $errors->first('max_claim_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.max_claim_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="processing_time_days">{{ trans('cruds.claimType.fields.processing_time_days') }}</label>
                <input class="form-control {{ $errors->has('processing_time_days') ? 'is-invalid' : '' }}" type="number" name="processing_time_days" id="processing_time_days" value="{{ old('processing_time_days', '') }}" step="1">
                @if($errors->has('processing_time_days'))
                    <span class="text-danger">{{ $errors->first('processing_time_days') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claimType.fields.processing_time_days_helper') }}</span>
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