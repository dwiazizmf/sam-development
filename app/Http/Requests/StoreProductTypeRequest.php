<?php

namespace App\Http\Requests;

use App\Models\ProductType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_type_create');
    }

    public function rules()
    {
        return [
            'product_type_code' => [
                'string',
                'nullable',
            ],
            'product_type_name' => [
                'string',
                'required',
            ],
        ];
    }
}
