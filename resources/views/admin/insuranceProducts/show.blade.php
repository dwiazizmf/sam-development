@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.insuranceProduct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.id') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.insurance_company') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->insurance_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.product_type') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->product_type->product_type_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.product_code') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->product_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.product_name') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->product_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.description') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.max_claim_amount') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->max_claim_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.commision') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->commision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.policy_duration_days') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->policy_duration_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.wording_product') }}
                        </th>
                        <td>
                            {{ $insuranceProduct->wording_product }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceProduct.fields.wording_product_doc') }}
                        </th>
                        <td>
                            @if($insuranceProduct->wording_product_doc)
                                <a href="{{ $insuranceProduct->wording_product_doc->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection