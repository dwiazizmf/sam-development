@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.crmCustomer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-customers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.crmCustomer.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.crmCustomer.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="role_id">{{ trans('cruds.crmCustomer.fields.role') }}</label>
                <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role_id" id="role_id">
                    @foreach($roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commission">{{ trans('cruds.crmCustomer.fields.commission') }}</label>
                <input class="form-control {{ $errors->has('commission') ? 'is-invalid' : '' }}" type="number" name="commission" id="commission" value="{{ old('commission', '') }}" step="0.01">
                @if($errors->has('commission'))
                    <span class="text-danger">{{ $errors->first('commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_pic">{{ trans('cruds.crmCustomer.fields.nama_pic') }}</label>
                <input class="form-control {{ $errors->has('nama_pic') ? 'is-invalid' : '' }}" type="text" name="nama_pic" id="nama_pic" value="{{ old('nama_pic', '') }}">
                @if($errors->has('nama_pic'))
                    <span class="text-danger">{{ $errors->first('nama_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.nama_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_telp_pic">{{ trans('cruds.crmCustomer.fields.no_telp_pic') }}</label>
                <input class="form-control {{ $errors->has('no_telp_pic') ? 'is-invalid' : '' }}" type="text" name="no_telp_pic" id="no_telp_pic" value="{{ old('no_telp_pic', '') }}">
                @if($errors->has('no_telp_pic'))
                    <span class="text-danger">{{ $errors->first('no_telp_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.no_telp_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_bank_pic">{{ trans('cruds.crmCustomer.fields.nama_bank_pic') }}</label>
                <input class="form-control {{ $errors->has('nama_bank_pic') ? 'is-invalid' : '' }}" type="text" name="nama_bank_pic" id="nama_bank_pic" value="{{ old('nama_bank_pic', '') }}">
                @if($errors->has('nama_bank_pic'))
                    <span class="text-danger">{{ $errors->first('nama_bank_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.nama_bank_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_rekening_pic">{{ trans('cruds.crmCustomer.fields.no_rekening_pic') }}</label>
                <input class="form-control {{ $errors->has('no_rekening_pic') ? 'is-invalid' : '' }}" type="text" name="no_rekening_pic" id="no_rekening_pic" value="{{ old('no_rekening_pic', '') }}">
                @if($errors->has('no_rekening_pic'))
                    <span class="text-danger">{{ $errors->first('no_rekening_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.no_rekening_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dokumen_legalitas">{{ trans('cruds.crmCustomer.fields.dokumen_legalitas') }}</label>
                <div class="needsclick dropzone {{ $errors->has('dokumen_legalitas') ? 'is-invalid' : '' }}" id="dokumen_legalitas-dropzone">
                </div>
                @if($errors->has('dokumen_legalitas'))
                    <span class="text-danger">{{ $errors->first('dokumen_legalitas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.dokumen_legalitas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.crmCustomer.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.crmCustomer.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ old('assigned_to_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.assigned_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prospects_source_id">{{ trans('cruds.crmCustomer.fields.prospects_source') }}</label>
                <select class="form-control select2 {{ $errors->has('prospects_source') ? 'is-invalid' : '' }}" name="prospects_source_id" id="prospects_source_id">
                    @foreach($prospects_sources as $id => $entry)
                        <option value="{{ $id }}" {{ old('prospects_source_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prospects_source'))
                    <span class="text-danger">{{ $errors->first('prospects_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.prospects_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="converted_date">{{ trans('cruds.crmCustomer.fields.converted_date') }}</label>
                <input class="form-control datetime {{ $errors->has('converted_date') ? 'is-invalid' : '' }}" type="text" name="converted_date" id="converted_date" value="{{ old('converted_date') }}">
                @if($errors->has('converted_date'))
                    <span class="text-danger">{{ $errors->first('converted_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmCustomer.fields.converted_date_helper') }}</span>
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
    var uploadedDokumenLegalitasMap = {}
Dropzone.options.dokumenLegalitasDropzone = {
    url: '{{ route('admin.crm-customers.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="dokumen_legalitas[]" value="' + response.name + '">')
      uploadedDokumenLegalitasMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDokumenLegalitasMap[file.name]
      }
      $('form').find('input[name="dokumen_legalitas[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($crmCustomer) && $crmCustomer->dokumen_legalitas)
          var files =
            {!! json_encode($crmCustomer->dokumen_legalitas) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="dokumen_legalitas[]" value="' + file.file_name + '">')
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