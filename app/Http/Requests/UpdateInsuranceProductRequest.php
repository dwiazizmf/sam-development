<?php

namespace App\Http\Requests;

use App\Models\InsuranceProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInsuranceProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('insurance_product_edit');
    }

    public function rules()
    {
        return [
            'insurance_company_id' => [
                'required',
                'integer',
            ],
            'product_type_id' => [
                'required',
                'integer',
            ],
            'product_code' => [
                'string',
                'nullable',
            ],
            'product_name' => [
                'string',
                'required',
            ],
            'max_claim_amount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'commision' => [
                'numeric',
            ],
            'policy_duration_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
