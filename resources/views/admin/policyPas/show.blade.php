@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyPa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-pas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.id') }}
                        </th>
                        <td>
                            {{ $policyPa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyPa->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $policyPa->insurance_product->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.nama_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyPa->nama_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.ttl_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyPa->ttl_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.alamat_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyPa->alamat_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.email') }}
                        </th>
                        <td>
                            {{ $policyPa->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.phone') }}
                        </th>
                        <td>
                            {{ $policyPa->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.nama_paket') }}
                        </th>
                        <td>
                            {{ $policyPa->nama_paket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.upload_dokumen') }}
                        </th>
                        <td>
                            @foreach($policyPa->upload_dokumen as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyPa.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policyPa->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-pas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection