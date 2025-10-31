@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crmCustomer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.id') }}
                        </th>
                        <td>
                            {{ $crmCustomer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.company') }}
                        </th>
                        <td>
                            {{ $crmCustomer->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $crmCustomer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.email') }}
                        </th>
                        <td>
                            {{ $crmCustomer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.role') }}
                        </th>
                        <td>
                            {{ $crmCustomer->role->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.address') }}
                        </th>
                        <td>
                            {{ $crmCustomer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.commission') }}
                        </th>
                        <td>
                            {{ $crmCustomer->commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.nama_pic') }}
                        </th>
                        <td>
                            {{ $crmCustomer->nama_pic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.no_telp_pic') }}
                        </th>
                        <td>
                            {{ $crmCustomer->no_telp_pic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.nama_bank_pic') }}
                        </th>
                        <td>
                            {{ $crmCustomer->nama_bank_pic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.no_rekening_pic') }}
                        </th>
                        <td>
                            {{ $crmCustomer->no_rekening_pic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.dokumen_legalitas') }}
                        </th>
                        <td>
                            @foreach($crmCustomer->dokumen_legalitas as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.status') }}
                        </th>
                        <td>
                            {{ $crmCustomer->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $crmCustomer->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.prospects_source') }}
                        </th>
                        <td>
                            {{ $crmCustomer->prospects_source->contact_first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.converted_date') }}
                        </th>
                        <td>
                            {{ $crmCustomer->converted_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.created_by') }}
                        </th>
                        <td>
                            {{ $crmCustomer->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection