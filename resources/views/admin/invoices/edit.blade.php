@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoices.update", [$invoice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="polis_id">{{ trans('cruds.invoice.fields.polis') }}</label>
                <select class="form-control select2 {{ $errors->has('polis') ? 'is-invalid' : '' }}" name="polis_id" id="polis_id" required>
                    @foreach($polis as $id => $entry)
                        <option value="{{ $id }}" {{ (old('polis_id') ? old('polis_id') : $invoice->polis->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('polis'))
                    <span class="text-danger">{{ $errors->first('polis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.polis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="invoice_number">{{ trans('cruds.invoice.fields.invoice_number') }}</label>
                <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}" type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}">
                @if($errors->has('invoice_number'))
                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.invoice.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $invoice->total_amount) }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subtotal_amount">{{ trans('cruds.invoice.fields.subtotal_amount') }}</label>
                <input class="form-control {{ $errors->has('subtotal_amount') ? 'is-invalid' : '' }}" type="number" name="subtotal_amount" id="subtotal_amount" value="{{ old('subtotal_amount', $invoice->subtotal_amount) }}" step="0.01">
                @if($errors->has('subtotal_amount'))
                    <span class="text-danger">{{ $errors->first('subtotal_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.subtotal_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_amount">{{ trans('cruds.invoice.fields.tax_amount') }}</label>
                <input class="form-control {{ $errors->has('tax_amount') ? 'is-invalid' : '' }}" type="number" name="tax_amount" id="tax_amount" value="{{ old('tax_amount', $invoice->tax_amount) }}" step="0.01">
                @if($errors->has('tax_amount'))
                    <span class="text-danger">{{ $errors->first('tax_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.tax_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount_amount">{{ trans('cruds.invoice.fields.discount_amount') }}</label>
                <input class="form-control {{ $errors->has('discount_amount') ? 'is-invalid' : '' }}" type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $invoice->discount_amount) }}" step="0.01">
                @if($errors->has('discount_amount'))
                    <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.discount_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.invoice.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Invoice::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $invoice->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="due_date">{{ trans('cruds.invoice.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date) }}">
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paid_at">{{ trans('cruds.invoice.fields.paid_at') }}</label>
                <input class="form-control date {{ $errors->has('paid_at') ? 'is-invalid' : '' }}" type="text" name="paid_at" id="paid_at" value="{{ old('paid_at', $invoice->paid_at) }}">
                @if($errors->has('paid_at'))
                    <span class="text-danger">{{ $errors->first('paid_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.paid_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method">{{ trans('cruds.invoice.fields.payment_method') }}</label>
                <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', $invoice->payment_method) }}">
                @if($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.invoice.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes', $invoice->notes) }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_no">{{ trans('cruds.invoice.fields.reference_no') }}</label>
                <input class="form-control {{ $errors->has('reference_no') ? 'is-invalid' : '' }}" type="text" name="reference_no" id="reference_no" value="{{ old('reference_no', $invoice->reference_no) }}">
                @if($errors->has('reference_no'))
                    <span class="text-danger">{{ $errors->first('reference_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.reference_no_helper') }}</span>
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