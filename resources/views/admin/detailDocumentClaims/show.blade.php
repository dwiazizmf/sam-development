@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.detailDocumentClaim.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.detail-document-claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.id') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.insurance_company') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->insurance_company->company_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->insurance_product->product_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.policies_data') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->policies_data->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.claim_type') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->claim_type->claim_type_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.claims') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->claims->claim_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.file_document_claim') }}
                        </th>
                        <td>
                            @if($detailDocumentClaim->file_document_claim)
                                <a href="{{ $detailDocumentClaim->file_document_claim->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detailDocumentClaim.fields.created_by') }}
                        </th>
                        <td>
                            {{ $detailDocumentClaim->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.detail-document-claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection