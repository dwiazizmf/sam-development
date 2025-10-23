@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.policyVehicle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.policy-vehicles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_policies_id">{{ trans('cruds.policyVehicle.fields.id_policies') }}</label>
                <select class="form-control select2 {{ $errors->has('id_policies') ? 'is-invalid' : '' }}" name="id_policies_id" id="id_policies_id" required>
                    @foreach($id_policies as $id => $entry)
                        <option value="{{ $id }}" {{ old('id_policies_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_policies'))
                    <span class="text-danger">{{ $errors->first('id_policies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.id_policies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merk_type">{{ trans('cruds.policyVehicle.fields.merk_type') }}</label>
                <input class="form-control {{ $errors->has('merk_type') ? 'is-invalid' : '' }}" type="text" name="merk_type" id="merk_type" value="{{ old('merk_type', '') }}">
                @if($errors->has('merk_type'))
                    <span class="text-danger">{{ $errors->first('merk_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.merk_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="warna_kendaraan">{{ trans('cruds.policyVehicle.fields.warna_kendaraan') }}</label>
                <input class="form-control {{ $errors->has('warna_kendaraan') ? 'is-invalid' : '' }}" type="text" name="warna_kendaraan" id="warna_kendaraan" value="{{ old('warna_kendaraan', '') }}">
                @if($errors->has('warna_kendaraan'))
                    <span class="text-danger">{{ $errors->first('warna_kendaraan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.warna_kendaraan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_pembuatan">{{ trans('cruds.policyVehicle.fields.tahun_pembuatan') }}</label>
                <input class="form-control {{ $errors->has('tahun_pembuatan') ? 'is-invalid' : '' }}" type="number" name="tahun_pembuatan" id="tahun_pembuatan" value="{{ old('tahun_pembuatan', '') }}" step="1">
                @if($errors->has('tahun_pembuatan'))
                    <span class="text-danger">{{ $errors->first('tahun_pembuatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.tahun_pembuatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_polisi">{{ trans('cruds.policyVehicle.fields.no_polisi') }}</label>
                <input class="form-control {{ $errors->has('no_polisi') ? 'is-invalid' : '' }}" type="text" name="no_polisi" id="no_polisi" value="{{ old('no_polisi', '') }}">
                @if($errors->has('no_polisi'))
                    <span class="text-danger">{{ $errors->first('no_polisi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_polisi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_rangka">{{ trans('cruds.policyVehicle.fields.no_rangka') }}</label>
                <input class="form-control {{ $errors->has('no_rangka') ? 'is-invalid' : '' }}" type="text" name="no_rangka" id="no_rangka" value="{{ old('no_rangka', '') }}">
                @if($errors->has('no_rangka'))
                    <span class="text-danger">{{ $errors->first('no_rangka') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_rangka_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_mesin">{{ trans('cruds.policyVehicle.fields.no_mesin') }}</label>
                <input class="form-control {{ $errors->has('no_mesin') ? 'is-invalid' : '' }}" type="text" name="no_mesin" id="no_mesin" value="{{ old('no_mesin', '') }}">
                @if($errors->has('no_mesin'))
                    <span class="text-danger">{{ $errors->first('no_mesin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_mesin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_tertanggung">{{ trans('cruds.policyVehicle.fields.nama_tertanggung') }}</label>
                <input class="form-control {{ $errors->has('nama_tertanggung') ? 'is-invalid' : '' }}" type="text" name="nama_tertanggung" id="nama_tertanggung" value="{{ old('nama_tertanggung', '') }}">
                @if($errors->has('nama_tertanggung'))
                    <span class="text-danger">{{ $errors->first('nama_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.nama_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat_tertanggung">{{ trans('cruds.policyVehicle.fields.alamat_tertanggung') }}</label>
                <textarea class="form-control {{ $errors->has('alamat_tertanggung') ? 'is-invalid' : '' }}" name="alamat_tertanggung" id="alamat_tertanggung">{{ old('alamat_tertanggung') }}</textarea>
                @if($errors->has('alamat_tertanggung'))
                    <span class="text-danger">{{ $errors->first('alamat_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.alamat_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.policyVehicle.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_hp">{{ trans('cruds.policyVehicle.fields.no_hp') }}</label>
                <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}">
                @if($errors->has('no_hp'))
                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_hp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_pertanggungan">{{ trans('cruds.policyVehicle.fields.nilai_pertanggungan') }}</label>
                <input class="form-control {{ $errors->has('nilai_pertanggungan') ? 'is-invalid' : '' }}" type="number" name="nilai_pertanggungan" id="nilai_pertanggungan" value="{{ old('nilai_pertanggungan', '') }}" step="0.01">
                @if($errors->has('nilai_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('nilai_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.nilai_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenis_pertanggungan_id">{{ trans('cruds.policyVehicle.fields.jenis_pertanggungan') }}</label>
                <select class="form-control select2 {{ $errors->has('jenis_pertanggungan') ? 'is-invalid' : '' }}" name="jenis_pertanggungan_id" id="jenis_pertanggungan_id">
                    @foreach($jenis_pertanggungans as $id => $entry)
                        <option value="{{ $id }}" {{ old('jenis_pertanggungan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('jenis_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.jenis_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="perluasan_pertanggungan_id">{{ trans('cruds.policyVehicle.fields.perluasan_pertanggungan') }}</label>
                <select class="form-control select2 {{ $errors->has('perluasan_pertanggungan') ? 'is-invalid' : '' }}" name="perluasan_pertanggungan_id" id="perluasan_pertanggungan_id">
                    @foreach($perluasan_pertanggungans as $id => $entry)
                        <option value="{{ $id }}" {{ old('perluasan_pertanggungan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('perluasan_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('perluasan_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.perluasan_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat_no">{{ trans('cruds.policyVehicle.fields.sertifikat_no') }}</label>
                <input class="form-control {{ $errors->has('sertifikat_no') ? 'is-invalid' : '' }}" type="text" name="sertifikat_no" id="sertifikat_no" value="{{ old('sertifikat_no', '') }}">
                @if($errors->has('sertifikat_no'))
                    <span class="text-danger">{{ $errors->first('sertifikat_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.sertifikat_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upload_kendaraan">{{ trans('cruds.policyVehicle.fields.upload_kendaraan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('upload_kendaraan') ? 'is-invalid' : '' }}" id="upload_kendaraan-dropzone">
                </div>
                @if($errors->has('upload_kendaraan'))
                    <span class="text-danger">{{ $errors->first('upload_kendaraan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.upload_kendaraan_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedUploadKendaraanMap = {}
Dropzone.options.uploadKendaraanDropzone = {
    url: '{{ route('admin.policy-vehicles.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="upload_kendaraan[]" value="' + response.name + '">')
      uploadedUploadKendaraanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedUploadKendaraanMap[file.name]
      }
      $('form').find('input[name="upload_kendaraan[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($policyVehicle) && $policyVehicle->upload_kendaraan)
          var files =
            {!! json_encode($policyVehicle->upload_kendaraan) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="upload_kendaraan[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection