<?php

namespace App\Http\Requests;

use App\Models\Claim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClaimRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('claim_create');
    }

    public function rules()
    {
        return [
            'claim_number' => [
                'string',
                'required',
            ],
            'claim_status' => [
                'required',
            ],
            'review_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'payment_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'payment_reference' => [
                'string',
                'nullable',
            ],
            'payment_method' => [
                'string',
                'nullable',
            ],
        ];
    }
}
