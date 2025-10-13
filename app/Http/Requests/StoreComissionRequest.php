<?php

namespace App\Http\Requests;

use App\Models\Comission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreComissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comission_create');
    }

    public function rules()
    {
        return [
            'assigned_to_users.*' => [
                'integer',
            ],
            'assigned_to_users' => [
                'array',
            ],
            'from_users.*' => [
                'integer',
            ],
            'from_users' => [
                'array',
            ],
            'polis_transactions.*' => [
                'integer',
            ],
            'polis_transactions' => [
                'array',
            ],
            'level' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
