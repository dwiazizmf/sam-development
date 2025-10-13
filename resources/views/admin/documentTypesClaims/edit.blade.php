@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.documentTypesClaim.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.document-types-claims.update", [$documentTypesClaim->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="document_code">{{ trans('cruds.documentTypesClaim.fields.document_code') }}</label>
                <input class="form-control {{ $errors->has('document_code') ? 'is-invalid' : '' }}" type="text" name="document_code" id="document_code" value="{{ old('document_code', $documentTypesClaim->document_code) }}">
                @if($errors->has('document_code'))
                    <span class="text-danger">{{ $errors->first('document_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.document_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document_name">{{ trans('cruds.documentTypesClaim.fields.document_name') }}</label>
                <input class="form-control {{ $errors->has('document_name') ? 'is-invalid' : '' }}" type="text" name="document_name" id="document_name" value="{{ old('document_name', $documentTypesClaim->document_name) }}" required>
                @if($errors->has('document_name'))
                    <span class="text-danger">{{ $errors->first('document_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.document_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="insurance_company_id">{{ trans('cruds.documentTypesClaim.fields.insurance_company') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_company') ? 'is-invalid' : '' }}" name="insurance_company_id" id="insurance_company_id" required>
                    @foreach($insurance_companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('insurance_company_id') ? old('insurance_company_id') : $documentTypesClaim->insurance_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_company'))
                    <span class="text-danger">{{ $errors->first('insurance_company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.insurance_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claim_type_group_id">{{ trans('cruds.documentTypesClaim.fields.claim_type_group') }}</label>
                <select class="form-control select2 {{ $errors->has('claim_type_group') ? 'is-invalid' : '' }}" name="claim_type_group_id" id="claim_type_group_id">
                    @foreach($claim_type_groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('claim_type_group_id') ? old('claim_type_group_id') : $documentTypesClaim->claim_type_group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_type_group'))
                    <span class="text-danger">{{ $errors->first('claim_type_group') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.claim_type_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claim_type_id">{{ trans('cruds.documentTypesClaim.fields.claim_type') }}</label>
                <select class="form-control select2 {{ $errors->has('claim_type') ? 'is-invalid' : '' }}" name="claim_type_id" id="claim_type_id">
                    @foreach($claim_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('claim_type_id') ? old('claim_type_id') : $documentTypesClaim->claim_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_type'))
                    <span class="text-danger">{{ $errors->first('claim_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.claim_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.documentTypesClaim.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $documentTypesClaim->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_format_allowed">{{ trans('cruds.documentTypesClaim.fields.file_format_allowed') }}</label>
                <input class="form-control {{ $errors->has('file_format_allowed') ? 'is-invalid' : '' }}" type="text" name="file_format_allowed" id="file_format_allowed" value="{{ old('file_format_allowed', $documentTypesClaim->file_format_allowed) }}" required>
                @if($errors->has('file_format_allowed'))
                    <span class="text-danger">{{ $errors->first('file_format_allowed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.file_format_allowed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_file_size_mb">{{ trans('cruds.documentTypesClaim.fields.max_file_size_mb') }}</label>
                <input class="form-control {{ $errors->has('max_file_size_mb') ? 'is-invalid' : '' }}" type="number" name="max_file_size_mb" id="max_file_size_mb" value="{{ old('max_file_size_mb', $documentTypesClaim->max_file_size_mb) }}" step="0.01">
                @if($errors->has('max_file_size_mb'))
                    <span class="text-danger">{{ $errors->first('max_file_size_mb') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.max_file_size_mb_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.documentTypesClaim.fields.is_image_only') }}</label>
                <select class="form-control {{ $errors->has('is_image_only') ? 'is-invalid' : '' }}" name="is_image_only" id="is_image_only" required>
                    <option value disabled {{ old('is_image_only', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DocumentTypesClaim::IS_IMAGE_ONLY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('is_image_only', $documentTypesClaim->is_image_only) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('is_image_only'))
                    <span class="text-danger">{{ $errors->first('is_image_only') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.is_image_only_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.documentTypesClaim.fields.require_original') }}</label>
                <select class="form-control {{ $errors->has('require_original') ? 'is-invalid' : '' }}" name="require_original" id="require_original" required>
                    <option value disabled {{ old('require_original', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DocumentTypesClaim::REQUIRE_ORIGINAL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('require_original', $documentTypesClaim->require_original) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('require_original'))
                    <span class="text-danger">{{ $errors->first('require_original') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.require_original_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="validation_rules">{{ trans('cruds.documentTypesClaim.fields.validation_rules') }}</label>
                <textarea class="form-control {{ $errors->has('validation_rules') ? 'is-invalid' : '' }}" name="validation_rules" id="validation_rules">{{ old('validation_rules', $documentTypesClaim->validation_rules) }}</textarea>
                @if($errors->has('validation_rules'))
                    <span class="text-danger">{{ $errors->first('validation_rules') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.validation_rules_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sample_document_path">{{ trans('cruds.documentTypesClaim.fields.sample_document_path') }}</label>
                <input class="form-control {{ $errors->has('sample_document_path') ? 'is-invalid' : '' }}" type="text" name="sample_document_path" id="sample_document_path" value="{{ old('sample_document_path', $documentTypesClaim->sample_document_path) }}">
                @if($errors->has('sample_document_path'))
                    <span class="text-danger">{{ $errors->first('sample_document_path') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentTypesClaim.fields.sample_document_path_helper') }}</span>
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