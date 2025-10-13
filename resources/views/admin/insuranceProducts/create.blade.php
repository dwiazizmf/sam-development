@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.insuranceProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.insurance-products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="insurance_company_id">{{ trans('cruds.insuranceProduct.fields.insurance_company') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_company') ? 'is-invalid' : '' }}" name="insurance_company_id" id="insurance_company_id" required>
                    @foreach($insurance_companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('insurance_company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_company'))
                    <span class="text-danger">{{ $errors->first('insurance_company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.insurance_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_type_id">{{ trans('cruds.insuranceProduct.fields.product_type') }}</label>
                <select class="form-control select2 {{ $errors->has('product_type') ? 'is-invalid' : '' }}" name="product_type_id" id="product_type_id" required>
                    @foreach($product_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_type'))
                    <span class="text-danger">{{ $errors->first('product_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.product_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_code">{{ trans('cruds.insuranceProduct.fields.product_code') }}</label>
                <input class="form-control {{ $errors->has('product_code') ? 'is-invalid' : '' }}" type="text" name="product_code" id="product_code" value="{{ old('product_code', '') }}">
                @if($errors->has('product_code'))
                    <span class="text-danger">{{ $errors->first('product_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.product_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_name">{{ trans('cruds.insuranceProduct.fields.product_name') }}</label>
                <input class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', '') }}" required>
                @if($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.product_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.insuranceProduct.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_claim_amount">{{ trans('cruds.insuranceProduct.fields.max_claim_amount') }}</label>
                <input class="form-control {{ $errors->has('max_claim_amount') ? 'is-invalid' : '' }}" type="number" name="max_claim_amount" id="max_claim_amount" value="{{ old('max_claim_amount', '1') }}" step="1">
                @if($errors->has('max_claim_amount'))
                    <span class="text-danger">{{ $errors->first('max_claim_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.max_claim_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commision">{{ trans('cruds.insuranceProduct.fields.commision') }}</label>
                <input class="form-control {{ $errors->has('commision') ? 'is-invalid' : '' }}" type="number" name="commision" id="commision" value="{{ old('commision', '') }}" step="0.01">
                @if($errors->has('commision'))
                    <span class="text-danger">{{ $errors->first('commision') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.commision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policy_duration_days">{{ trans('cruds.insuranceProduct.fields.policy_duration_days') }}</label>
                <input class="form-control {{ $errors->has('policy_duration_days') ? 'is-invalid' : '' }}" type="number" name="policy_duration_days" id="policy_duration_days" value="{{ old('policy_duration_days', '1') }}" step="1">
                @if($errors->has('policy_duration_days'))
                    <span class="text-danger">{{ $errors->first('policy_duration_days') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.policy_duration_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wording_product">{{ trans('cruds.insuranceProduct.fields.wording_product') }}</label>
                <textarea class="form-control {{ $errors->has('wording_product') ? 'is-invalid' : '' }}" name="wording_product" id="wording_product">{{ old('wording_product') }}</textarea>
                @if($errors->has('wording_product'))
                    <span class="text-danger">{{ $errors->first('wording_product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.wording_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wording_product_doc">{{ trans('cruds.insuranceProduct.fields.wording_product_doc') }}</label>
                <div class="needsclick dropzone {{ $errors->has('wording_product_doc') ? 'is-invalid' : '' }}" id="wording_product_doc-dropzone">
                </div>
                @if($errors->has('wording_product_doc'))
                    <span class="text-danger">{{ $errors->first('wording_product_doc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insuranceProduct.fields.wording_product_doc_helper') }}</span>
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
    Dropzone.options.wordingProductDocDropzone = {
    url: '{{ route('admin.insurance-products.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="wording_product_doc"]').remove()
      $('form').append('<input type="hidden" name="wording_product_doc" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="wording_product_doc"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($insuranceProduct) && $insuranceProduct->wording_product_doc)
      var file = {!! json_encode($insuranceProduct->wording_product_doc) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="wording_product_doc" value="' + file.file_name + '">')
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