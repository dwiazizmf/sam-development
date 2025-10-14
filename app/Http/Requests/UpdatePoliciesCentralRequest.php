<?php

namespace App\Http\Requests;

use App\Models\PoliciesCentral;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePoliciesCentralRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policies_central_edit');
    }

    public function rules()
    {
        return [
            'policy_number' => [
                'string',
                'required',
                'unique:policies_centrals,policy_number,' . request()->route('policies_central')->id,
            ],
            'policy_number_external' => [
                'string',
                'nullable',
            ],
            'insurance_product_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'premium_amount' => [
                'required',
            ],
            'discount' => [
                'numeric',
            ],
            'discount_total' => [
                'numeric',
            ],
            'sum_insured' => [
                'required',
            ],
            'policy_status' => [
                'required',
            ],
            'payment_status' => [
                'required',
            ],
            'external_polis_doc' => [
                'array',
            ],
        ];
    }
}
