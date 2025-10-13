<?php

namespace App\Http\Requests;

use App\Models\StatusProspect;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStatusProspectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('status_prospect_create');
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
