@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.claim.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.claims.update", [$claim->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="claim_number">{{ trans('cruds.claim.fields.claim_number') }}</label>
                <input class="form-control {{ $errors->has('claim_number') ? 'is-invalid' : '' }}" type="text" name="claim_number" id="claim_number" value="{{ old('claim_number', $claim->claim_number) }}" required>
                @if($errors->has('claim_number'))
                    <span class="text-danger">{{ $errors->first('claim_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.claim_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policies_id">{{ trans('cruds.claim.fields.policies') }}</label>
                <select class="form-control select2 {{ $errors->has('policies') ? 'is-invalid' : '' }}" name="policies_id" id="policies_id">
                    @foreach($policies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('policies_id') ? old('policies_id') : $claim->policies->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('policies'))
                    <span class="text-danger">{{ $errors->first('policies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.policies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claim_type_id">{{ trans('cruds.claim.fields.claim_type') }}</label>
                <select class="form-control select2 {{ $errors->has('claim_type') ? 'is-invalid' : '' }}" name="claim_type_id" id="claim_type_id">
                    @foreach($claim_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('claim_type_id') ? old('claim_type_id') : $claim->claim_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_type'))
                    <span class="text-danger">{{ $errors->first('claim_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.claim_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.claim.fields.claim_status') }}</label>
                <select class="form-control {{ $errors->has('claim_status') ? 'is-invalid' : '' }}" name="claim_status" id="claim_status" required>
                    <option value disabled {{ old('claim_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Claim::CLAIM_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('claim_status', $claim->claim_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('claim_status'))
                    <span class="text-danger">{{ $errors->first('claim_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.claim_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reviewed_by_user_id">{{ trans('cruds.claim.fields.reviewed_by_user') }}</label>
                <select class="form-control select2 {{ $errors->has('reviewed_by_user') ? 'is-invalid' : '' }}" name="reviewed_by_user_id" id="reviewed_by_user_id">
                    @foreach($reviewed_by_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('reviewed_by_user_id') ? old('reviewed_by_user_id') : $claim->reviewed_by_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reviewed_by_user'))
                    <span class="text-danger">{{ $errors->first('reviewed_by_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.reviewed_by_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="review_date">{{ trans('cruds.claim.fields.review_date') }}</label>
                <input class="form-control datetime {{ $errors->has('review_date') ? 'is-invalid' : '' }}" type="text" name="review_date" id="review_date" value="{{ old('review_date', $claim->review_date) }}">
                @if($errors->has('review_date'))
                    <span class="text-danger">{{ $errors->first('review_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.review_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="review_notes">{{ trans('cruds.claim.fields.review_notes') }}</label>
                <textarea class="form-control {{ $errors->has('review_notes') ? 'is-invalid' : '' }}" name="review_notes" id="review_notes">{{ old('review_notes', $claim->review_notes) }}</textarea>
                @if($errors->has('review_notes'))
                    <span class="text-danger">{{ $errors->first('review_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.review_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_amount">{{ trans('cruds.claim.fields.approved_amount') }}</label>
                <input class="form-control {{ $errors->has('approved_amount') ? 'is-invalid' : '' }}" type="number" name="approved_amount" id="approved_amount" value="{{ old('approved_amount', $claim->approved_amount) }}" step="0.01">
                @if($errors->has('approved_amount'))
                    <span class="text-danger">{{ $errors->first('approved_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.approved_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_date">{{ trans('cruds.claim.fields.payment_date') }}</label>
                <input class="form-control datetime {{ $errors->has('payment_date') ? 'is-invalid' : '' }}" type="text" name="payment_date" id="payment_date" value="{{ old('payment_date', $claim->payment_date) }}">
                @if($errors->has('payment_date'))
                    <span class="text-danger">{{ $errors->first('payment_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.payment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_reference">{{ trans('cruds.claim.fields.payment_reference') }}</label>
                <input class="form-control {{ $errors->has('payment_reference') ? 'is-invalid' : '' }}" type="text" name="payment_reference" id="payment_reference" value="{{ old('payment_reference', $claim->payment_reference) }}">
                @if($errors->has('payment_reference'))
                    <span class="text-danger">{{ $errors->first('payment_reference') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.payment_reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method">{{ trans('cruds.claim.fields.payment_method') }}</label>
                <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', $claim->payment_method) }}">
                @if($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.claim.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_user_id') ? old('assigned_to_user_id') : $claim->assigned_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.assigned_to_user_helper') }}</span>
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