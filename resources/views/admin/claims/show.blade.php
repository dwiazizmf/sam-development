@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.claim.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.id') }}
                        </th>
                        <td>
                            {{ $claim->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.claim_number') }}
                        </th>
                        <td>
                            {{ $claim->claim_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.policies') }}
                        </th>
                        <td>
                            {{ $claim->policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.claim_type') }}
                        </th>
                        <td>
                            {{ $claim->claim_type->claim_type_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.claim_status') }}
                        </th>
                        <td>
                            {{ App\Models\Claim::CLAIM_STATUS_SELECT[$claim->claim_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.reviewed_by_user') }}
                        </th>
                        <td>
                            {{ $claim->reviewed_by_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.review_date') }}
                        </th>
                        <td>
                            {{ $claim->review_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.review_notes') }}
                        </th>
                        <td>
                            {{ $claim->review_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.approved_amount') }}
                        </th>
                        <td>
                            {{ $claim->approved_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.payment_date') }}
                        </th>
                        <td>
                            {{ $claim->payment_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.payment_reference') }}
                        </th>
                        <td>
                            {{ $claim->payment_reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $claim->payment_method }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $claim->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claim.fields.created_by') }}
                        </th>
                        <td>
                            {{ $claim->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.claims.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#claims_detail_document_claims" role="tab" data-toggle="tab">
                {{ trans('cruds.detailDocumentClaim.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="claims_detail_document_claims">
            @includeIf('admin.claims.relationships.claimsDetailDocumentClaims', ['detailDocumentClaims' => $claim->claimsDetailDocumentClaims])
        </div>
    </div>
</div>

@endsection