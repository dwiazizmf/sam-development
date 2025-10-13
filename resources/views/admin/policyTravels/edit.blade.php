@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.policyTravel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.policy-travels.update", [$policyTravel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="id_policies_id">{{ trans('cruds.policyTravel.fields.id_policies') }}</label>
                <select class="form-control select2 {{ $errors->has('id_policies') ? 'is-invalid' : '' }}" name="id_policies_id" id="id_policies_id" required>
                    @foreach($id_policies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_policies_id') ? old('id_policies_id') : $policyTravel->id_policies->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_policies'))
                    <span class="text-danger">{{ $errors->first('id_policies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.id_policies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insurance_product_id">{{ trans('cruds.policyTravel.fields.insurance_product') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_product') ? 'is-invalid' : '' }}" name="insurance_product_id" id="insurance_product_id">
                    @foreach($insurance_products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('insurance_product_id') ? old('insurance_product_id') : $policyTravel->insurance_product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_product'))
                    <span class="text-danger">{{ $errors->first('insurance_product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.insurance_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="polis_name">{{ trans('cruds.policyTravel.fields.polis_name') }}</label>
                <input class="form-control {{ $errors->has('polis_name') ? 'is-invalid' : '' }}" type="text" name="polis_name" id="polis_name" value="{{ old('polis_name', $policyTravel->polis_name) }}" required>
                @if($errors->has('polis_name'))
                    <span class="text-danger">{{ $errors->first('polis_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.polis_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="policyholder_address">{{ trans('cruds.policyTravel.fields.policyholder_address') }}</label>
                <textarea class="form-control {{ $errors->has('policyholder_address') ? 'is-invalid' : '' }}" name="policyholder_address" id="policyholder_address" required>{{ old('policyholder_address', $policyTravel->policyholder_address) }}</textarea>
                @if($errors->has('policyholder_address'))
                    <span class="text-danger">{{ $errors->first('policyholder_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.policyholder_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jumlah_wisatawan">{{ trans('cruds.policyTravel.fields.jumlah_wisatawan') }}</label>
                <input class="form-control {{ $errors->has('jumlah_wisatawan') ? 'is-invalid' : '' }}" type="number" name="jumlah_wisatawan" id="jumlah_wisatawan" value="{{ old('jumlah_wisatawan', $policyTravel->jumlah_wisatawan) }}" step="1" required>
                @if($errors->has('jumlah_wisatawan'))
                    <span class="text-danger">{{ $errors->first('jumlah_wisatawan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.jumlah_wisatawan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="asal_keberangkatan">{{ trans('cruds.policyTravel.fields.asal_keberangkatan') }}</label>
                <input class="form-control {{ $errors->has('asal_keberangkatan') ? 'is-invalid' : '' }}" type="text" name="asal_keberangkatan" id="asal_keberangkatan" value="{{ old('asal_keberangkatan', $policyTravel->asal_keberangkatan) }}">
                @if($errors->has('asal_keberangkatan'))
                    <span class="text-danger">{{ $errors->first('asal_keberangkatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.asal_keberangkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tujuan_keberangkatan">{{ trans('cruds.policyTravel.fields.tujuan_keberangkatan') }}</label>
                <input class="form-control {{ $errors->has('tujuan_keberangkatan') ? 'is-invalid' : '' }}" type="text" name="tujuan_keberangkatan" id="tujuan_keberangkatan" value="{{ old('tujuan_keberangkatan', $policyTravel->tujuan_keberangkatan) }}">
                @if($errors->has('tujuan_keberangkatan'))
                    <span class="text-danger">{{ $errors->first('tujuan_keberangkatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.tujuan_keberangkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_paket">{{ trans('cruds.policyTravel.fields.nama_paket') }}</label>
                <input class="form-control {{ $errors->has('nama_paket') ? 'is-invalid' : '' }}" type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket', $policyTravel->nama_paket) }}">
                @if($errors->has('nama_paket'))
                    <span class="text-danger">{{ $errors->first('nama_paket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.nama_paket_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upload">{{ trans('cruds.policyTravel.fields.upload') }}</label>
                <div class="needsclick dropzone {{ $errors->has('upload') ? 'is-invalid' : '' }}" id="upload-dropzone">
                </div>
                @if($errors->has('upload'))
                    <span class="text-danger">{{ $errors->first('upload') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyTravel.fields.upload_helper') }}</span>
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
    var uploadedUploadMap = {}
Dropzone.options.uploadDropzone = {
    url: '{{ route('admin.policy-travels.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="upload[]" value="' + response.name + '">')
      uploadedUploadMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedUploadMap[file.name]
      }
      $('form').find('input[name="upload[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($policyTravel) && $policyTravel->upload)
          var files =
            {!! json_encode($policyTravel->upload) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="upload[]" value="' + file.file_name + '">')
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