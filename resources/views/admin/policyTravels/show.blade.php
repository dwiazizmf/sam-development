@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.policyTravel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-travels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.id') }}
                        </th>
                        <td>
                            {{ $policyTravel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.id_policies') }}
                        </th>
                        <td>
                            {{ $policyTravel->id_policies->policy_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.insurance_product') }}
                        </th>
                        <td>
                            {{ $policyTravel->insurance_product->product_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.polis_name') }}
                        </th>
                        <td>
                            {{ $policyTravel->polis_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.policyholder_address') }}
                        </th>
                        <td>
                            {{ $policyTravel->policyholder_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.jumlah_wisatawan') }}
                        </th>
                        <td>
                            {{ $policyTravel->jumlah_wisatawan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.asal_keberangkatan') }}
                        </th>
                        <td>
                            {{ $policyTravel->asal_keberangkatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.tujuan_keberangkatan') }}
                        </th>
                        <td>
                            {{ $policyTravel->tujuan_keberangkatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.nama_paket') }}
                        </th>
                        <td>
                            {{ $policyTravel->nama_paket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.created_by') }}
                        </th>
                        <td>
                            {{ $policyTravel->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.policyTravel.fields.upload') }}
                        </th>
                        <td>
                            @foreach($policyTravel->upload as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.policy-travels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection