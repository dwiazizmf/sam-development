@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.claimType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.claim-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.id') }}
                        </th>
                        <td>
                            {{ $claimType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.claim_gorup') }}
                        </th>
                        <td>
                            {{ $claimType->claim_gorup->claim_group_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.claim_type_code') }}
                        </th>
                        <td>
                            {{ $claimType->claim_type_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.claim_type_name') }}
                        </th>
                        <td>
                            {{ $claimType->claim_type_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.description') }}
                        </th>
                        <td>
                            {{ $claimType->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.max_claim_amount') }}
                        </th>
                        <td>
                            {{ $claimType->max_claim_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.claimType.fields.processing_time_days') }}
                        </th>
                        <td>
                            {{ $claimType->processing_time_days }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.claim-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection