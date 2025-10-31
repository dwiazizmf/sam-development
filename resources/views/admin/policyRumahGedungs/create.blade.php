@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.policyRumahGedung.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.policy-rumah-gedungs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_policies_id">{{ trans('cruds.policyRumahGedung.fields.id_policies') }}</label>
                <select class="form-control select2 {{ $errors->has('id_policies') ? 'is-invalid' : '' }}" name="id_policies_id" id="id_policies_id" required>
                    @foreach($id_policies as $id => $entry)
                        <option value="{{ $id }}" {{ old('id_policies_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_policies'))
                    <span class="text-danger">{{ $errors->first('id_policies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.id_policies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insurance_product_id">{{ trans('cruds.policyRumahGedung.fields.insurance_product') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_product') ? 'is-invalid' : '' }}" name="insurance_product_id" id="insurance_product_id">
                    @foreach($insurance_products as $id => $entry)
                        <option value="{{ $id }}" {{ old('insurance_product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_product'))
                    <span class="text-danger">{{ $errors->first('insurance_product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.insurance_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lokasi_pertanggungan">{{ trans('cruds.policyRumahGedung.fields.lokasi_pertanggungan') }}</label>
                <input class="form-control {{ $errors->has('lokasi_pertanggungan') ? 'is-invalid' : '' }}" type="text" name="lokasi_pertanggungan" id="lokasi_pertanggungan" value="{{ old('lokasi_pertanggungan', '') }}">
                @if($errors->has('lokasi_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('lokasi_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.lokasi_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenis_rumah_gedung_id">{{ trans('cruds.policyRumahGedung.fields.jenis_rumah_gedung') }}</label>
                <select class="form-control select2 {{ $errors->has('jenis_rumah_gedung') ? 'is-invalid' : '' }}" name="jenis_rumah_gedung_id" id="jenis_rumah_gedung_id">
                    @foreach($jenis_rumah_gedungs as $id => $entry)
                        <option value="{{ $id }}" {{ old('jenis_rumah_gedung_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_rumah_gedung'))
                    <span class="text-danger">{{ $errors->first('jenis_rumah_gedung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.jenis_rumah_gedung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.policyRumahGedung.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenis_paket_id">{{ trans('cruds.policyRumahGedung.fields.jenis_paket') }}</label>
                <select class="form-control select2 {{ $errors->has('jenis_paket') ? 'is-invalid' : '' }}" name="jenis_paket_id" id="jenis_paket_id">
                    @foreach($jenis_pakets as $id => $entry)
                        <option value="{{ $id }}" {{ old('jenis_paket_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_paket'))
                    <span class="text-danger">{{ $errors->first('jenis_paket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.jenis_paket_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_tertanggung">{{ trans('cruds.policyRumahGedung.fields.nama_tertanggung') }}</label>
                <input class="form-control {{ $errors->has('nama_tertanggung') ? 'is-invalid' : '' }}" type="text" name="nama_tertanggung" id="nama_tertanggung" value="{{ old('nama_tertanggung', '') }}">
                @if($errors->has('nama_tertanggung'))
                    <span class="text-danger">{{ $errors->first('nama_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.nama_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ttl_tertanggung">{{ trans('cruds.policyRumahGedung.fields.ttl_tertanggung') }}</label>
                <input class="form-control date {{ $errors->has('ttl_tertanggung') ? 'is-invalid' : '' }}" type="text" name="ttl_tertanggung" id="ttl_tertanggung" value="{{ old('ttl_tertanggung') }}">
                @if($errors->has('ttl_tertanggung'))
                    <span class="text-danger">{{ $errors->first('ttl_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.ttl_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat_tertanggung">{{ trans('cruds.policyRumahGedung.fields.alamat_tertanggung') }}</label>
                <input class="form-control {{ $errors->has('alamat_tertanggung') ? 'is-invalid' : '' }}" type="text" name="alamat_tertanggung" id="alamat_tertanggung" value="{{ old('alamat_tertanggung', '') }}">
                @if($errors->has('alamat_tertanggung'))
                    <span class="text-danger">{{ $errors->first('alamat_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.alamat_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.policyRumahGedung.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_phone">{{ trans('cruds.policyRumahGedung.fields.no_phone') }}</label>
                <input class="form-control {{ $errors->has('no_phone') ? 'is-invalid' : '' }}" type="text" name="no_phone" id="no_phone" value="{{ old('no_phone', '') }}">
                @if($errors->has('no_phone'))
                    <span class="text-danger">{{ $errors->first('no_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.no_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_paket">{{ trans('cruds.policyRumahGedung.fields.nama_paket') }}</label>
                <input class="form-control {{ $errors->has('nama_paket') ? 'is-invalid' : '' }}" type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket', '') }}">
                @if($errors->has('nama_paket'))
                    <span class="text-danger">{{ $errors->first('nama_paket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.nama_paket_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upload_dokumen">{{ trans('cruds.policyRumahGedung.fields.upload_dokumen') }}</label>
                <div class="needsclick dropzone {{ $errors->has('upload_dokumen') ? 'is-invalid' : '' }}" id="upload_dokumen-dropzone">
                </div>
                @if($errors->has('upload_dokumen'))
                    <span class="text-danger">{{ $errors->first('upload_dokumen') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyRumahGedung.fields.upload_dokumen_helper') }}</span>
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
    var uploadedUploadDokumenMap = {}
Dropzone.options.uploadDokumenDropzone = {
    url: '{{ route('admin.policy-rumah-gedungs.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="upload_dokumen[]" value="' + response.name + '">')
      uploadedUploadDokumenMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedUploadDokumenMap[file.name]
      }
      $('form').find('input[name="upload_dokumen[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($policyRumahGedung) && $policyRumahGedung->upload_dokumen)
          var files =
            {!! json_encode($policyRumahGedung->upload_dokumen) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="upload_dokumen[]" value="' + file.file_name + '">')
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