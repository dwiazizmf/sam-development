@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.policiesCentral.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.policies-centrals.update", [$policiesCentral->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="assigned_to_customer_id">{{ trans('cruds.policiesCentral.fields.assigned_to_customer') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_customer') ? 'is-invalid' : '' }}" name="assigned_to_customer_id" id="assigned_to_customer_id">
                    @foreach($assigned_to_customers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_customer_id') ? old('assigned_to_customer_id') : $policiesCentral->assigned_to_customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_customer'))
                    <span class="text-danger">{{ $errors->first('assigned_to_customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.assigned_to_customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="policy_number">{{ trans('cruds.policiesCentral.fields.policy_number') }}</label>
                <input class="form-control {{ $errors->has('policy_number') ? 'is-invalid' : '' }}" type="text" name="policy_number" id="policy_number" value="{{ old('policy_number', $policiesCentral->policy_number) }}" required>
                @if($errors->has('policy_number'))
                    <span class="text-danger">{{ $errors->first('policy_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.policy_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policy_number_external">{{ trans('cruds.policiesCentral.fields.policy_number_external') }}</label>
                <input class="form-control {{ $errors->has('policy_number_external') ? 'is-invalid' : '' }}" type="text" name="policy_number_external" id="policy_number_external" value="{{ old('policy_number_external', $policiesCentral->policy_number_external) }}">
                @if($errors->has('policy_number_external'))
                    <span class="text-danger">{{ $errors->first('policy_number_external') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.policy_number_external_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="insurance_product_id">{{ trans('cruds.policiesCentral.fields.insurance_product') }}</label>
                <select class="form-control select2 {{ $errors->has('insurance_product') ? 'is-invalid' : '' }}" name="insurance_product_id" id="insurance_product_id" required>
                    @foreach($insurance_products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('insurance_product_id') ? old('insurance_product_id') : $policiesCentral->insurance_product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('insurance_product'))
                    <span class="text-danger">{{ $errors->first('insurance_product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.insurance_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="periode">{{ trans('cruds.policiesCentral.fields.periode') }}</label>
                <input class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" type="text" name="periode" id="periode" value="{{ old('periode', $policiesCentral->periode) }}">
                @if($errors->has('periode'))
                    <span class="text-danger">{{ $errors->first('periode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.periode_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="premium_amount">{{ trans('cruds.policiesCentral.fields.premium_amount') }}</label>
                <input class="form-control {{ $errors->has('premium_amount') ? 'is-invalid' : '' }}" type="number" name="premium_amount" id="premium_amount" value="{{ old('premium_amount', $policiesCentral->premium_amount) }}" step="0.01" required>
                @if($errors->has('premium_amount'))
                    <span class="text-danger">{{ $errors->first('premium_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.premium_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.policiesCentral.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $policiesCentral->discount) }}" step="0.01">
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount_total">{{ trans('cruds.policiesCentral.fields.discount_total') }}</label>
                <input class="form-control {{ $errors->has('discount_total') ? 'is-invalid' : '' }}" type="number" name="discount_total" id="discount_total" value="{{ old('discount_total', $policiesCentral->discount_total) }}" step="0.01">
                @if($errors->has('discount_total'))
                    <span class="text-danger">{{ $errors->first('discount_total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.discount_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="aksessoris_tambahan">{{ trans('cruds.policiesCentral.fields.aksessoris_tambahan') }}</label>
                <input class="form-control {{ $errors->has('aksessoris_tambahan') ? 'is-invalid' : '' }}" type="number" name="aksessoris_tambahan" id="aksessoris_tambahan" value="{{ old('aksessoris_tambahan', $policiesCentral->aksessoris_tambahan) }}" step="0.01">
                @if($errors->has('aksessoris_tambahan'))
                    <span class="text-danger">{{ $errors->first('aksessoris_tambahan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.aksessoris_tambahan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="aksesoris_harga">{{ trans('cruds.policiesCentral.fields.aksesoris_harga') }}</label>
                <input class="form-control {{ $errors->has('aksesoris_harga') ? 'is-invalid' : '' }}" type="number" name="aksesoris_harga" id="aksesoris_harga" value="{{ old('aksesoris_harga', $policiesCentral->aksesoris_harga) }}" step="0.01">
                @if($errors->has('aksesoris_harga'))
                    <span class="text-danger">{{ $errors->first('aksesoris_harga') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.aksesoris_harga_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="biaya_lainnya">{{ trans('cruds.policiesCentral.fields.biaya_lainnya') }}</label>
                <input class="form-control {{ $errors->has('biaya_lainnya') ? 'is-invalid' : '' }}" type="number" name="biaya_lainnya" id="biaya_lainnya" value="{{ old('biaya_lainnya', $policiesCentral->biaya_lainnya) }}" step="0.01">
                @if($errors->has('biaya_lainnya'))
                    <span class="text-danger">{{ $errors->first('biaya_lainnya') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.biaya_lainnya_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sum_insured">{{ trans('cruds.policiesCentral.fields.sum_insured') }}</label>
                <input class="form-control {{ $errors->has('sum_insured') ? 'is-invalid' : '' }}" type="number" name="sum_insured" id="sum_insured" value="{{ old('sum_insured', $policiesCentral->sum_insured) }}" step="0.01" required>
                @if($errors->has('sum_insured'))
                    <span class="text-danger">{{ $errors->first('sum_insured') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.sum_insured_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.policiesCentral.fields.policy_status') }}</label>
                <select class="form-control {{ $errors->has('policy_status') ? 'is-invalid' : '' }}" name="policy_status" id="policy_status" required>
                    <option value disabled {{ old('policy_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PoliciesCentral::POLICY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('policy_status', $policiesCentral->policy_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('policy_status'))
                    <span class="text-danger">{{ $errors->first('policy_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.policy_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.policiesCentral.fields.payment_status') }}</label>
                <select class="form-control {{ $errors->has('payment_status') ? 'is-invalid' : '' }}" name="payment_status" id="payment_status" required>
                    <option value disabled {{ old('payment_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PoliciesCentral::PAYMENT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_status', $policiesCentral->payment_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_status'))
                    <span class="text-danger">{{ $errors->first('payment_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.payment_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="external_polis_doc">{{ trans('cruds.policiesCentral.fields.external_polis_doc') }}</label>
                <div class="needsclick dropzone {{ $errors->has('external_polis_doc') ? 'is-invalid' : '' }}" id="external_polis_doc-dropzone">
                </div>
                @if($errors->has('external_polis_doc'))
                    <span class="text-danger">{{ $errors->first('external_polis_doc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.external_polis_doc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.policiesCentral.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_user_id') ? old('assigned_to_user_id') : $policiesCentral->assigned_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.assigned_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.policiesCentral.fields.data_source') }}</label>
                <select class="form-control {{ $errors->has('data_source') ? 'is-invalid' : '' }}" name="data_source" id="data_source" required>
                    <option value disabled {{ old('data_source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PoliciesCentral::DATA_SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('data_source', $policiesCentral->data_source) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('data_source'))
                    <span class="text-danger">{{ $errors->first('data_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.data_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="external_policy_id">{{ trans('cruds.policiesCentral.fields.external_policy') }}</label>
                <select class="form-control select2 {{ $errors->has('external_policy') ? 'is-invalid' : '' }}" name="external_policy_id" id="external_policy_id">
                    @foreach($external_policies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('external_policy_id') ? old('external_policy_id') : $policiesCentral->external_policy->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('external_policy'))
                    <span class="text-danger">{{ $errors->first('external_policy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.external_policy_helper') }}</span>
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
    var uploadedExternalPolisDocMap = {}
Dropzone.options.externalPolisDocDropzone = {
    url: '{{ route('admin.policies-centrals.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="external_polis_doc[]" value="' + response.name + '">')
      uploadedExternalPolisDocMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedExternalPolisDocMap[file.name]
      }
      $('form').find('input[name="external_polis_doc[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($policiesCentral) && $policiesCentral->external_polis_doc)
          var files =
            {!! json_encode($policiesCentral->external_polis_doc) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="external_polis_doc[]" value="' + file.file_name + '">')
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