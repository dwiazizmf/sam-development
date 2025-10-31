@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contactCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-companies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="business_type_id">{{ trans('cruds.contactCompany.fields.business_type') }}</label>
                <select class="form-control select2 {{ $errors->has('business_type') ? 'is-invalid' : '' }}" name="business_type_id" id="business_type_id" required>
                    @foreach($business_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('business_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('business_type'))
                    <span class="text-danger">{{ $errors->first('business_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.business_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.contactCompany.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_telp">{{ trans('cruds.contactCompany.fields.no_telp') }}</label>
                <input class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}" type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', '') }}" required>
                @if($errors->has('no_telp'))
                    <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.no_telp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.contactCompany.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_email">{{ trans('cruds.contactCompany.fields.company_email') }}</label>
                <input class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" type="text" name="company_email" id="company_email" value="{{ old('company_email', '') }}">
                @if($errors->has('company_email'))
                    <span class="text-danger">{{ $errors->first('company_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_address">{{ trans('cruds.contactCompany.fields.company_address') }}</label>
                <input class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}" type="text" name="company_address" id="company_address" value="{{ old('company_address', '') }}">
                @if($errors->has('company_address'))
                    <span class="text-danger">{{ $errors->first('company_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.contactCompany.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province">{{ trans('cruds.contactCompany.fields.province') }}</label>
                <input class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}" type="text" name="province" id="province" value="{{ old('province', '') }}">
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_website">{{ trans('cruds.contactCompany.fields.company_website') }}</label>
                <input class="form-control {{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text" name="company_website" id="company_website" value="{{ old('company_website', '') }}">
                @if($errors->has('company_website'))
                    <span class="text-danger">{{ $errors->first('company_website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_bank_companies">{{ trans('cruds.contactCompany.fields.nama_bank_companies') }}</label>
                <input class="form-control {{ $errors->has('nama_bank_companies') ? 'is-invalid' : '' }}" type="text" name="nama_bank_companies" id="nama_bank_companies" value="{{ old('nama_bank_companies', '') }}">
                @if($errors->has('nama_bank_companies'))
                    <span class="text-danger">{{ $errors->first('nama_bank_companies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.nama_bank_companies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_rekening_companies">{{ trans('cruds.contactCompany.fields.no_rekening_companies') }}</label>
                <input class="form-control {{ $errors->has('no_rekening_companies') ? 'is-invalid' : '' }}" type="text" name="no_rekening_companies" id="no_rekening_companies" value="{{ old('no_rekening_companies', '') }}">
                @if($errors->has('no_rekening_companies'))
                    <span class="text-danger">{{ $errors->first('no_rekening_companies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.no_rekening_companies_helper') }}</span>
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