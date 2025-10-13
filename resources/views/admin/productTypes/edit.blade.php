@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-types.update", [$productType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_type_code">{{ trans('cruds.productType.fields.product_type_code') }}</label>
                <input class="form-control {{ $errors->has('product_type_code') ? 'is-invalid' : '' }}" type="text" name="product_type_code" id="product_type_code" value="{{ old('product_type_code', $productType->product_type_code) }}">
                @if($errors->has('product_type_code'))
                    <span class="text-danger">{{ $errors->first('product_type_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productType.fields.product_type_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_type_name">{{ trans('cruds.productType.fields.product_type_name') }}</label>
                <input class="form-control {{ $errors->has('product_type_name') ? 'is-invalid' : '' }}" type="text" name="product_type_name" id="product_type_name" value="{{ old('product_type_name', $productType->product_type_name) }}" required>
                @if($errors->has('product_type_name'))
                    <span class="text-danger">{{ $errors->first('product_type_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productType.fields.product_type_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_type_description">{{ trans('cruds.productType.fields.product_type_description') }}</label>
                <textarea class="form-control {{ $errors->has('product_type_description') ? 'is-invalid' : '' }}" name="product_type_description" id="product_type_description">{{ old('product_type_description', $productType->product_type_description) }}</textarea>
                @if($errors->has('product_type_description'))
                    <span class="text-danger">{{ $errors->first('product_type_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productType.fields.product_type_description_helper') }}</span>
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