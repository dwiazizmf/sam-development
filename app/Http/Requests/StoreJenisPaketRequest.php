<?php

namespace App\Http\Requests;

use App\Models\JenisPaket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJenisPaketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenis_paket_create');
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
