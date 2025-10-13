<?php

namespace App\Http\Requests;

use App\Models\BusinessType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
