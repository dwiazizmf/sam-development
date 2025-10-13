<?php

namespace App\Http\Requests;

use App\Models\ClaimType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClaimTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('claim_type_edit');
    }

    public function rules()
    {
        return [
            'claim_gorup_id' => [
                'required',
                'integer',
            ],
            'claim_type_code' => [
                'string',
                'nullable',
            ],
            'claim_type_name' => [
                'string',
                'required',
            ],
            'processing_time_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
