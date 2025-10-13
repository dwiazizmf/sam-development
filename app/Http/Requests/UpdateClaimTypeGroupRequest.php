<?php

namespace App\Http\Requests;

use App\Models\ClaimTypeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClaimTypeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('claim_type_group_edit');
    }

    public function rules()
    {
        return [
            'claim_group_code' => [
                'string',
                'nullable',
            ],
            'claim_group_name' => [
                'string',
                'required',
            ],
        ];
    }
}
