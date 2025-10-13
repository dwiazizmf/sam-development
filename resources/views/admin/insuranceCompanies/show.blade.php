@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.insuranceCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.id') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.company_code') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->company_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.company_name') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.company_short_name') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->company_short_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.phone') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.address') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.city') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.province') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.postal_code') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->postal_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.email') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.website') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.contact_person') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->contact_person }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.contact_position') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->contact_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.contact_phone') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->contact_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $insuranceCompany->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insuranceCompany.fields.logo') }}
                        </th>
                        <td>
                            @if($insuranceCompany->logo)
                                <a href="{{ $insuranceCompany->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $insuranceCompany->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurance-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection