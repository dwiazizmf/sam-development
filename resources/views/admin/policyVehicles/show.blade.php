@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyVehicle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.id') }}
                        </th>
                        <td>
                            {{ $policyVehicle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyVehicle->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.merk_type') }}
                        </th>
                        <td>
                            {{ $policyVehicle->merk_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.warna_kendaraan') }}
                        </th>
                        <td>
                            {{ $policyVehicle->warna_kendaraan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.tahun_pembuatan') }}
                        </th>
                        <td>
                            {{ $policyVehicle->tahun_pembuatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.no_polisi') }}
                        </th>
                        <td>
                            {{ $policyVehicle->no_polisi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.no_rangka') }}
                        </th>
                        <td>
                            {{ $policyVehicle->no_rangka }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.no_mesin') }}
                        </th>
                        <td>
                            {{ $policyVehicle->no_mesin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.nama_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyVehicle->nama_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.alamat_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyVehicle->alamat_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.email') }}
                        </th>
                        <td>
                            {{ $policyVehicle->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.no_hp') }}
                        </th>
                        <td>
                            {{ $policyVehicle->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.nilai_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyVehicle->nilai_pertanggungan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.jenis_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyVehicle->jenis_pertanggungan->jenis_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.perluasan_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyVehicle->perluasan_pertanggungan->pertanggungan_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.sertifikat_no') }}
                        </th>
                        <td>
                            {{ $policyVehicle->sertifikat_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.upload_kendaraan') }}
                        </th>
                        <td>
                            @foreach($policyVehicle->upload_kendaraan as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyVehicle.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policyVehicle->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection