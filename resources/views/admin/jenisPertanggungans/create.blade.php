@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jenisPertanggungan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jenis-pertanggungans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="jenis_name">{{ trans('cruds.jenisPertanggungan.fields.jenis_name') }}</label>
                <input class="form-control {{ $errors->has('jenis_name') ? 'is-invalid' : '' }}" type="text" name="jenis_name" id="jenis_name" value="{{ old('jenis_name', '') }}" required>
                @if($errors->has('jenis_name'))
                    <span class="text-danger">{{ $errors->first('jenis_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisPertanggungan.fields.jenis_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.jenisPertanggungan.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', '') }}">
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisPertanggungan.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection