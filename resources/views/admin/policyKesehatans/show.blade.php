@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyKesehatan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-kesehatans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.id') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->insurance_product->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.nama_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->nama_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.ttl_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->ttl_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.alamat_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->alamat_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.email') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.phone') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.nama_paket') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->nama_paket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.upload_dokumen') }}
                        </th>
                        <td>
                            @foreach($policyKesehatan->upload_dokumen as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyKesehatan.fields.assigned_to_customer') }}
                        </th>
                        <td>
                            {{ $policyKesehatan->assigned_to_customer->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-kesehatans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection