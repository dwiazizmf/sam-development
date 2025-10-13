@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.documentTypesClaim.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.document-types-claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.id') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.document_code') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->document_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.document_name') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->document_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.insurance_company') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->insurance_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.claim_type_group') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->claim_type_group->claim_group_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.claim_type') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->claim_type->claim_type_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.description') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.file_format_allowed') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->file_format_allowed }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.max_file_size_mb') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->max_file_size_mb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.is_image_only') }}
                        </th>
                        <td>
                            {{ App\Models\DocumentTypesClaim::IS_IMAGE_ONLY_SELECT[$documentTypesClaim->is_image_only] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.require_original') }}
                        </th>
                        <td>
                            {{ App\Models\DocumentTypesClaim::REQUIRE_ORIGINAL_SELECT[$documentTypesClaim->require_original] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.validation_rules') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->validation_rules }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentTypesClaim.fields.sample_document_path') }}
                        </th>
                        <td>
                            {{ $documentTypesClaim->sample_document_path }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.document-types-claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection