@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contactContact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-contacts.update", [$contactContact->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.contactContact.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $contactContact->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_first_name">{{ trans('cruds.contactContact.fields.contact_first_name') }}</label>
                <input class="form-control {{ $errors->has('contact_first_name') ? 'is-invalid' : '' }}" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', $contactContact->contact_first_name) }}" required>
                @if($errors->has('contact_first_name'))
                    <span class="text-danger">{{ $errors->first('contact_first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_last_name">{{ trans('cruds.contactContact.fields.contact_last_name') }}</label>
                <input class="form-control {{ $errors->has('contact_last_name') ? 'is-invalid' : '' }}" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', $contactContact->contact_last_name) }}">
                @if($errors->has('contact_last_name'))
                    <span class="text-danger">{{ $errors->first('contact_last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_phone_1">{{ trans('cruds.contactContact.fields.contact_phone_1') }}</label>
                <input class="form-control {{ $errors->has('contact_phone_1') ? 'is-invalid' : '' }}" type="text" name="contact_phone_1" id="contact_phone_1" value="{{ old('contact_phone_1', $contactContact->contact_phone_1) }}" required>
                @if($errors->has('contact_phone_1'))
                    <span class="text-danger">{{ $errors->first('contact_phone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone_2">{{ trans('cruds.contactContact.fields.contact_phone_2') }}</label>
                <input class="form-control {{ $errors->has('contact_phone_2') ? 'is-invalid' : '' }}" type="text" name="contact_phone_2" id="contact_phone_2" value="{{ old('contact_phone_2', $contactContact->contact_phone_2) }}">
                @if($errors->has('contact_phone_2'))
                    <span class="text-danger">{{ $errors->first('contact_phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.contactContact.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', $contactContact->contact_email) }}">
                @if($errors->has('contact_email'))
                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_address">{{ trans('cruds.contactContact.fields.contact_address') }}</label>
                <input class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $contactContact->contact_address) }}">
                @if($errors->has('contact_address'))
                    <span class="text-danger">{{ $errors->first('contact_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contactContact.fields.lead_source') }}</label>
                <select class="form-control {{ $errors->has('lead_source') ? 'is-invalid' : '' }}" name="lead_source" id="lead_source">
                    <option value disabled {{ old('lead_source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ContactContact::LEAD_SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('lead_source', $contactContact->lead_source) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('lead_source'))
                    <span class="text-danger">{{ $errors->first('lead_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.lead_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lead_source_detail">{{ trans('cruds.contactContact.fields.lead_source_detail') }}</label>
                <input class="form-control {{ $errors->has('lead_source_detail') ? 'is-invalid' : '' }}" type="text" name="lead_source_detail" id="lead_source_detail" value="{{ old('lead_source_detail', $contactContact->lead_source_detail) }}">
                @if($errors->has('lead_source_detail'))
                    <span class="text-danger">{{ $errors->first('lead_source_detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.lead_source_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="potential_revenue">{{ trans('cruds.contactContact.fields.potential_revenue') }}</label>
                <input class="form-control {{ $errors->has('potential_revenue') ? 'is-invalid' : '' }}" type="number" name="potential_revenue" id="potential_revenue" value="{{ old('potential_revenue', $contactContact->potential_revenue) }}" step="0.01">
                @if($errors->has('potential_revenue'))
                    <span class="text-danger">{{ $errors->first('potential_revenue') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.potential_revenue_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estimated_policies_per_month">{{ trans('cruds.contactContact.fields.estimated_policies_per_month') }}</label>
                <input class="form-control {{ $errors->has('estimated_policies_per_month') ? 'is-invalid' : '' }}" type="text" name="estimated_policies_per_month" id="estimated_policies_per_month" value="{{ old('estimated_policies_per_month', $contactContact->estimated_policies_per_month) }}">
                @if($errors->has('estimated_policies_per_month'))
                    <span class="text-danger">{{ $errors->first('estimated_policies_per_month') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.estimated_policies_per_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contactContact.fields.priority') }}</label>
                <select class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority" id="priority">
                    <option value disabled {{ old('priority', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ContactContact::PRIORITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('priority', $contactContact->priority) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_prospect_id">{{ trans('cruds.contactContact.fields.status_prospect') }}</label>
                <select class="form-control select2 {{ $errors->has('status_prospect') ? 'is-invalid' : '' }}" name="status_prospect_id" id="status_prospect_id">
                    @foreach($status_prospects as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_prospect_id') ? old('status_prospect_id') : $contactContact->status_prospect->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_prospect'))
                    <span class="text-danger">{{ $errors->first('status_prospect') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.status_prospect_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.contactContact.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_user_id') ? old('assigned_to_user_id') : $contactContact->assigned_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.assigned_to_user_helper') }}</span>
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