@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.perluasanPertanggungan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.perluasan-pertanggungans.update", [$perluasanPertanggungan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="pertanggungan_name">{{ trans('cruds.perluasanPertanggungan.fields.pertanggungan_name') }}</label>
                <input class="form-control {{ $errors->has('pertanggungan_name') ? 'is-invalid' : '' }}" type="text" name="pertanggungan_name" id="pertanggungan_name" value="{{ old('pertanggungan_name', $perluasanPertanggungan->pertanggungan_name) }}">
                @if($errors->has('pertanggungan_name'))
                    <span class="text-danger">{{ $errors->first('pertanggungan_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.perluasanPertanggungan.fields.pertanggungan_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.perluasanPertanggungan.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan', $perluasanPertanggungan->keterangan) }}</textarea>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.perluasanPertanggungan.fields.keterangan_helper') }}</span>
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