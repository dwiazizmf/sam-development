<?php

namespace App\Http\Requests;

use App\Models\ProductType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_type_edit');
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
