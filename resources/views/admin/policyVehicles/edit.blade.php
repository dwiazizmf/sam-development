@extends('layouts.admin')
@section('content')

<form method="POST" action="{{ route("admin.policy-vehicles.update", [$policyVehicle->id]) }}" enctype="multipart/form-data">
@method('PUT')
@csrf
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.policiesCentral.title_singular') }}
    </div>

    <div class="card-body">
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
                <label for="aksessoris_tambahan">{{ trans('cruds.policiesCentral.fields.aksessoris_tambahan') }}</label>
                <input class="form-control {{ $errors->has('aksessoris_tambahan') ? 'is-invalid' : '' }}" type="text" name="aksessoris_tambahan" id="aksessoris_tambahan" value="{{ old('aksessoris_tambahan', $policiesCentral->aksessoris_tambahan) }}">
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
        {{ trans('global.edit') }} {{ trans('cruds.policyVehicle.title_singular') }}
    </div>

    <div class="card-body">
            <div class="form-group">
                <label for="merk_type">{{ trans('cruds.policyVehicle.fields.merk_type') }}</label>
                <input class="form-control {{ $errors->has('merk_type') ? 'is-invalid' : '' }}" type="text" name="merk_type" id="merk_type" value="{{ old('merk_type', $policyVehicle->merk_type) }}">
                @if($errors->has('merk_type'))
                    <span class="text-danger">{{ $errors->first('merk_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.merk_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="warna_kendaraan">{{ trans('cruds.policyVehicle.fields.warna_kendaraan') }}</label>
                <input class="form-control {{ $errors->has('warna_kendaraan') ? 'is-invalid' : '' }}" type="text" name="warna_kendaraan" id="warna_kendaraan" value="{{ old('warna_kendaraan', $policyVehicle->warna_kendaraan) }}">
                @if($errors->has('warna_kendaraan'))
                    <span class="text-danger">{{ $errors->first('warna_kendaraan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.warna_kendaraan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_pembuatan">{{ trans('cruds.policyVehicle.fields.tahun_pembuatan') }}</label>
                <input class="form-control {{ $errors->has('tahun_pembuatan') ? 'is-invalid' : '' }}" type="number" name="tahun_pembuatan" id="tahun_pembuatan" value="{{ old('tahun_pembuatan', $policyVehicle->tahun_pembuatan) }}" step="1">
                @if($errors->has('tahun_pembuatan'))
                    <span class="text-danger">{{ $errors->first('tahun_pembuatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.tahun_pembuatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_polisi">{{ trans('cruds.policyVehicle.fields.no_polisi') }}</label>
                <input class="form-control {{ $errors->has('no_polisi') ? 'is-invalid' : '' }}" type="text" name="no_polisi" id="no_polisi" value="{{ old('no_polisi', $policyVehicle->no_polisi) }}">
                @if($errors->has('no_polisi'))
                    <span class="text-danger">{{ $errors->first('no_polisi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_polisi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_rangka">{{ trans('cruds.policyVehicle.fields.no_rangka') }}</label>
                <input class="form-control {{ $errors->has('no_rangka') ? 'is-invalid' : '' }}" type="text" name="no_rangka" id="no_rangka" value="{{ old('no_rangka', $policyVehicle->no_rangka) }}">
                @if($errors->has('no_rangka'))
                    <span class="text-danger">{{ $errors->first('no_rangka') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_rangka_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_mesin">{{ trans('cruds.policyVehicle.fields.no_mesin') }}</label>
                <input class="form-control {{ $errors->has('no_mesin') ? 'is-invalid' : '' }}" type="text" name="no_mesin" id="no_mesin" value="{{ old('no_mesin', $policyVehicle->no_mesin) }}">
                @if($errors->has('no_mesin'))
                    <span class="text-danger">{{ $errors->first('no_mesin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_mesin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_tertanggung">{{ trans('cruds.policyVehicle.fields.nama_tertanggung') }}</label>
                <input class="form-control {{ $errors->has('nama_tertanggung') ? 'is-invalid' : '' }}" type="text" name="nama_tertanggung" id="nama_tertanggung" value="{{ old('nama_tertanggung', $policyVehicle->nama_tertanggung) }}">
                @if($errors->has('nama_tertanggung'))
                    <span class="text-danger">{{ $errors->first('nama_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.nama_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat_tertanggung">{{ trans('cruds.policyVehicle.fields.alamat_tertanggung') }}</label>
                <textarea class="form-control {{ $errors->has('alamat_tertanggung') ? 'is-invalid' : '' }}" name="alamat_tertanggung" id="alamat_tertanggung">{{ old('alamat_tertanggung', $policyVehicle->alamat_tertanggung) }}</textarea>
                @if($errors->has('alamat_tertanggung'))
                    <span class="text-danger">{{ $errors->first('alamat_tertanggung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.alamat_tertanggung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.policyVehicle.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $policyVehicle->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_hp">{{ trans('cruds.policyVehicle.fields.no_hp') }}</label>
                <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $policyVehicle->no_hp) }}">
                @if($errors->has('no_hp'))
                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.no_hp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_pertanggungan">{{ trans('cruds.policyVehicle.fields.nilai_pertanggungan') }}</label>
                <input class="form-control {{ $errors->has('nilai_pertanggungan') ? 'is-invalid' : '' }}" type="number" name="nilai_pertanggungan" id="nilai_pertanggungan" value="{{ old('nilai_pertanggungan', $policyVehicle->nilai_pertanggungan) }}" step="0.01">
                @if($errors->has('nilai_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('nilai_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.nilai_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenis_pertanggungan_id">{{ trans('cruds.policyVehicle.fields.jenis_pertanggungan') }}</label>
                <select class="form-control select2 {{ $errors->has('jenis_pertanggungan') ? 'is-invalid' : '' }}" name="jenis_pertanggungan_id" id="jenis_pertanggungan_id">
                    @foreach($jenis_pertanggungans as $id => $entry)
                        <option value="{{ $id }}" {{ (old('jenis_pertanggungan_id') ? old('jenis_pertanggungan_id') : $policyVehicle->jenis_pertanggungan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('perluasan_pertanggungan_id') ? old('perluasan_pertanggungan_id') : $policyVehicle->perluasan_pertanggungan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('perluasan_pertanggungan'))
                    <span class="text-danger">{{ $errors->first('perluasan_pertanggungan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.policyVehicle.fields.perluasan_pertanggungan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat_no">{{ trans('cruds.policyVehicle.fields.sertifikat_no') }}</label>
                <input class="form-control {{ $errors->has('sertifikat_no') ? 'is-invalid' : '' }}" type="text" name="sertifikat_no" id="sertifikat_no" value="{{ old('sertifikat_no', $policyVehicle->sertifikat_no) }}">
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