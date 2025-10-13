@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyMotor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-motors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.id') }}
                        </th>
                        <td>
                            {{ $policyMotor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyMotor->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.merk_type') }}
                        </th>
                        <td>
                            {{ $policyMotor->merk_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.warna_kendaraan') }}
                        </th>
                        <td>
                            {{ $policyMotor->warna_kendaraan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.tahun_pembuatan') }}
                        </th>
                        <td>
                            {{ $policyMotor->tahun_pembuatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.no_polisi') }}
                        </th>
                        <td>
                            {{ $policyMotor->no_polisi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.no_rangka') }}
                        </th>
                        <td>
                            {{ $policyMotor->no_rangka }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.no_mesin') }}
                        </th>
                        <td>
                            {{ $policyMotor->no_mesin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.nama_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyMotor->nama_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.alamat_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyMotor->alamat_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.email') }}
                        </th>
                        <td>
                            {{ $policyMotor->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.no_hp') }}
                        </th>
                        <td>
                            {{ $policyMotor->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.nilai_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyMotor->nilai_pertanggungan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.jenis_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyMotor->jenis_pertanggungan->jenis_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.perluasan_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyMotor->perluasan_pertanggungan->pertanggungan_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.sertifikat_no') }}
                        </th>
                        <td>
                            {{ $policyMotor->sertifikat_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.upload_kendaraan') }}
                        </th>
                        <td>
                            @foreach($policyMotor->upload_kendaraan as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyMotor.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policyMotor->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-motors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection