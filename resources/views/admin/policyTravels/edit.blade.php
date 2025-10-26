@extends('layouts.admin')
@section('content')

<form method="POST" action="{{ route("admin.policy-travels.update", [$policyTravel->id]) }}" enctype="multipart/form-data">
@method('PUT')
@csrf
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
                <label class="required" for="start_date">{{ trans('cruds.policiesCentral.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $policiesCentral->start_date) }}" required>
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.policiesCentral.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $policiesCentral->end_date) }}" required>
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policiesCentral.fields.end_date_helper') }}</span>
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
            @if($isAdmin)
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
            @else
                <input type="hidden" name="assigned_to_user_id" id="assigned_to_user_id" value="{{ Auth::user()->id }}">
            @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.policyTravel.title_singular') }}
    </div>

    <div class="card-body">
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</form>

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