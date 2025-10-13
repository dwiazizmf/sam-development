@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jenisRumahGedung.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-rumah-gedungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisRumahGedung.fields.id') }}
                        </th>
                        <td>
                            {{ $jenisRumahGedung->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisRumahGedung.fields.name') }}
                        </th>
                        <td>
                            {{ $jenisRumahGedung->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisRumahGedung.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $jenisRumahGedung->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-rumah-gedungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection