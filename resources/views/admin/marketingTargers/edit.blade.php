@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.marketingTarger.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marketing-targers.update", [$marketingTarger->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="assigned_to_user_id">{{ trans('cruds.marketingTarger.fields.assigned_to_user') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to_user') ? 'is-invalid' : '' }}" name="assigned_to_user_id" id="assigned_to_user_id">
                    @foreach($assigned_to_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_user_id') ? old('assigned_to_user_id') : $marketingTarger->assigned_to_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_user'))
                    <span class="text-danger">{{ $errors->first('assigned_to_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.assigned_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="target_year">{{ trans('cruds.marketingTarger.fields.target_year') }}</label>
                <input class="form-control {{ $errors->has('target_year') ? 'is-invalid' : '' }}" type="number" name="target_year" id="target_year" value="{{ old('target_year', $marketingTarger->target_year) }}" step="1">
                @if($errors->has('target_year'))
                    <span class="text-danger">{{ $errors->first('target_year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.target_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="target_month">{{ trans('cruds.marketingTarger.fields.target_month') }}</label>
                <input class="form-control {{ $errors->has('target_month') ? 'is-invalid' : '' }}" type="number" name="target_month" id="target_month" value="{{ old('target_month', $marketingTarger->target_month) }}" step="1">
                @if($errors->has('target_month'))
                    <span class="text-danger">{{ $errors->first('target_month') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.target_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="new_prospects_target">{{ trans('cruds.marketingTarger.fields.new_prospects_target') }}</label>
                <input class="form-control {{ $errors->has('new_prospects_target') ? 'is-invalid' : '' }}" type="number" name="new_prospects_target" id="new_prospects_target" value="{{ old('new_prospects_target', $marketingTarger->new_prospects_target) }}" step="1">
                @if($errors->has('new_prospects_target'))
                    <span class="text-danger">{{ $errors->first('new_prospects_target') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.new_prospects_target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conversion_target">{{ trans('cruds.marketingTarger.fields.conversion_target') }}</label>
                <input class="form-control {{ $errors->has('conversion_target') ? 'is-invalid' : '' }}" type="number" name="conversion_target" id="conversion_target" value="{{ old('conversion_target', $marketingTarger->conversion_target) }}" step="1">
                @if($errors->has('conversion_target'))
                    <span class="text-danger">{{ $errors->first('conversion_target') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.conversion_target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="revenue_target">{{ trans('cruds.marketingTarger.fields.revenue_target') }}</label>
                <input class="form-control {{ $errors->has('revenue_target') ? 'is-invalid' : '' }}" type="number" name="revenue_target" id="revenue_target" value="{{ old('revenue_target', $marketingTarger->revenue_target) }}" step="1">
                @if($errors->has('revenue_target'))
                    <span class="text-danger">{{ $errors->first('revenue_target') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.revenue_target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policies_target">{{ trans('cruds.marketingTarger.fields.policies_target') }}</label>
                <input class="form-control {{ $errors->has('policies_target') ? 'is-invalid' : '' }}" type="number" name="policies_target" id="policies_target" value="{{ old('policies_target', $marketingTarger->policies_target) }}" step="1">
                @if($errors->has('policies_target'))
                    <span class="text-danger">{{ $errors->first('policies_target') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.policies_target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="followup_frequency_target">{{ trans('cruds.marketingTarger.fields.followup_frequency_target') }}</label>
                <input class="form-control {{ $errors->has('followup_frequency_target') ? 'is-invalid' : '' }}" type="number" name="followup_frequency_target" id="followup_frequency_target" value="{{ old('followup_frequency_target', $marketingTarger->followup_frequency_target) }}" step="1">
                @if($errors->has('followup_frequency_target'))
                    <span class="text-danger">{{ $errors->first('followup_frequency_target') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.followup_frequency_target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="new_prospects_achieved">{{ trans('cruds.marketingTarger.fields.new_prospects_achieved') }}</label>
                <input class="form-control {{ $errors->has('new_prospects_achieved') ? 'is-invalid' : '' }}" type="number" name="new_prospects_achieved" id="new_prospects_achieved" value="{{ old('new_prospects_achieved', $marketingTarger->new_prospects_achieved) }}" step="1">
                @if($errors->has('new_prospects_achieved'))
                    <span class="text-danger">{{ $errors->first('new_prospects_achieved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.new_prospects_achieved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conversion_achieved">{{ trans('cruds.marketingTarger.fields.conversion_achieved') }}</label>
                <input class="form-control {{ $errors->has('conversion_achieved') ? 'is-invalid' : '' }}" type="number" name="conversion_achieved" id="conversion_achieved" value="{{ old('conversion_achieved', $marketingTarger->conversion_achieved) }}" step="1">
                @if($errors->has('conversion_achieved'))
                    <span class="text-danger">{{ $errors->first('conversion_achieved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.conversion_achieved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="revenue_achieved">{{ trans('cruds.marketingTarger.fields.revenue_achieved') }}</label>
                <input class="form-control {{ $errors->has('revenue_achieved') ? 'is-invalid' : '' }}" type="number" name="revenue_achieved" id="revenue_achieved" value="{{ old('revenue_achieved', $marketingTarger->revenue_achieved) }}" step="1">
                @if($errors->has('revenue_achieved'))
                    <span class="text-danger">{{ $errors->first('revenue_achieved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.revenue_achieved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policies_achieved">{{ trans('cruds.marketingTarger.fields.policies_achieved') }}</label>
                <input class="form-control {{ $errors->has('policies_achieved') ? 'is-invalid' : '' }}" type="number" name="policies_achieved" id="policies_achieved" value="{{ old('policies_achieved', $marketingTarger->policies_achieved) }}" step="1">
                @if($errors->has('policies_achieved'))
                    <span class="text-danger">{{ $errors->first('policies_achieved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.policies_achieved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="followup_frequency_achieved">{{ trans('cruds.marketingTarger.fields.followup_frequency_achieved') }}</label>
                <input class="form-control {{ $errors->has('followup_frequency_achieved') ? 'is-invalid' : '' }}" type="number" name="followup_frequency_achieved" id="followup_frequency_achieved" value="{{ old('followup_frequency_achieved', $marketingTarger->followup_frequency_achieved) }}" step="1">
                @if($errors->has('followup_frequency_achieved'))
                    <span class="text-danger">{{ $errors->first('followup_frequency_achieved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marketingTarger.fields.followup_frequency_achieved_helper') }}</span>
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