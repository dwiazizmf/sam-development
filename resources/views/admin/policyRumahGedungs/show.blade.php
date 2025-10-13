@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyRumahGedung.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-rumah-gedungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.id') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->insurance_product->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.lokasi_pertanggungan') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->lokasi_pertanggungan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.jenis_rumah_gedung') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->jenis_rumah_gedung->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.jenis_paket') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->jenis_paket->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.nama_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->nama_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.ttl_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->ttl_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.alamat_tertanggung') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->alamat_tertanggung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.email') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.no_phone') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->no_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.nama_paket') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->nama_paket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.upload_dokumen') }}
                        </th>
                        <td>
                            @foreach($policyRumahGedung->upload_dokumen as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyRumahGedung.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policyRumahGedung->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-rumah-gedungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection