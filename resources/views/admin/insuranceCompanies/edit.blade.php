@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.insuranceCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.insurance-companies.update", [$insuranceCompany->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="company_code">{{ trans('cruds.insuranceCompany.fields.company_code') }}</label>
                <input class="form-control {{ $errors->has('company_code') ? 'is-invalid' : '' }}" type="text" name="company_code" id="company_code" value="{{ old('company_code', $insuranceCompany->company_code) }}">
                @if($errors->has('company_code'))
                    <span class="text-danger">{{ $errors->first('company_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.company_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.insuranceCompany.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $insuranceCompany->company_name) }}" required>
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_short_name">{{ trans('cruds.insuranceCompany.fields.company_short_name') }}</label>
                <input class="form-control {{ $errors->has('company_short_name') ? 'is-invalid' : '' }}" type="text" name="company_short_name" id="company_short_name" value="{{ old('company_short_name', $insuranceCompany->company_short_name) }}">
                @if($errors->has('company_short_name'))
                    <span class="text-danger">{{ $errors->first('company_short_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.company_short_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.insuranceCompany.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $insuranceCompany->phone) }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.insuranceCompany.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address', $insuranceCompany->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.insuranceCompany.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $insuranceCompany->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province">{{ trans('cruds.insuranceCompany.fields.province') }}</label>
                <input class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}" type="text" name="province" id="province" value="{{ old('province', $insuranceCompany->province) }}">
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="postal_code">{{ trans('cruds.insuranceCompany.fields.postal_code') }}</label>
                <input class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $insuranceCompany->postal_code) }}">
                @if($errors->has('postal_code'))
                    <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.postal_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.insuranceCompany.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $insuranceCompany->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.insuranceCompany.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $insuranceCompany->website) }}">
                @if($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_person">{{ trans('cruds.insuranceCompany.fields.contact_person') }}</label>
                <input class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}" type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', $insuranceCompany->contact_person) }}" required>
                @if($errors->has('contact_person'))
                    <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.contact_person_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_position">{{ trans('cruds.insuranceCompany.fields.contact_position') }}</label>
                <input class="form-control {{ $errors->has('contact_position') ? 'is-invalid' : '' }}" type="text" name="contact_position" id="contact_position" value="{{ old('contact_position', $insuranceCompany->contact_position) }}" required>
                @if($errors->has('contact_position'))
                    <span class="text-danger">{{ $errors->first('contact_position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.contact_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone">{{ trans('cruds.insuranceCompany.fields.contact_phone') }}</label>
                <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $insuranceCompany->contact_phone) }}">
                @if($errors->has('contact_phone'))
                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.contact_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.insuranceCompany.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $insuranceCompany->contact_email) }}">
                @if($errors->has('contact_email'))
                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.insuranceCompany.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceCompany.fields.logo_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.insurance-companies.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($insuranceCompany) && $insuranceCompany->logo)
      var file = {!! json_encode($insuranceCompany->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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