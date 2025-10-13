<?php

namespace App\Http\Requests;

use App\Models\ApiSyncLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreApiSyncLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('api_sync_log_create');
    }

    public function rules()
    {
        return [
            'system_name' => [
                'string',
                'nullable',
            ],
            'endpoint' => [
                'string',
                'nullable',
            ],
            'response_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
