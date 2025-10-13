@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.comission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comissions.update", [$comission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="assigned_to_users">{{ trans('cruds.comission.fields.assigned_to_user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assigned_to_users') ? 'is-invalid' : '' }}" name="assigned_to_users[]" id="assigned_to_users" multiple>
                    @foreach($assigned_to_users as $id => $assigned_to_user)
                        <option value="{{ $id }}" {{ (in_array($id, old('assigned_to_users', [])) || $comission->assigned_to_users->contains($id)) ? 'selected' : '' }}>{{ $assigned_to_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_users'))
                    <span class="text-danger">{{ $errors->first('assigned_to_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comission.fields.assigned_to_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_users">{{ trans('cruds.comission.fields.from_user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('from_users') ? 'is-invalid' : '' }}" name="from_users[]" id="from_users" multiple>
                    @foreach($from_users as $id => $from_user)
                        <option value="{{ $id }}" {{ (in_array($id, old('from_users', [])) || $comission->from_users->contains($id)) ? 'selected' : '' }}>{{ $from_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('from_users'))
                    <span class="text-danger">{{ $errors->first('from_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comission.fields.from_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="polis_transactions">{{ trans('cruds.comission.fields.polis_transaction') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('polis_transactions') ? 'is-invalid' : '' }}" name="polis_transactions[]" id="polis_transactions" multiple>
                    @foreach($polis_transactions as $id => $polis_transaction)
                        <option value="{{ $id }}" {{ (in_array($id, old('polis_transactions', [])) || $comission->polis_transactions->contains($id)) ? 'selected' : '' }}>{{ $polis_transaction }}</option>
                    @endforeach
                </select>
                @if($errors->has('polis_transactions'))
                    <span class="text-danger">{{ $errors->first('polis_transactions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comission.fields.polis_transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="level">{{ trans('cruds.comission.fields.level') }}</label>
                <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="number" name="level" id="level" value="{{ old('level', $comission->level) }}" step="1">
                @if($errors->has('level'))
                    <span class="text-danger">{{ $errors->first('level') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comission.fields.level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.comission.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $comission->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comission.fields.amount_helper') }}</span>
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