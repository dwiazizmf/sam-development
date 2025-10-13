<?php

namespace App\Http\Requests;

use App\Models\JenisPertanggungan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJenisPertanggunganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenis_pertanggungan_edit');
    }

    public function rules()
    {
        return [
            'jenis_name' => [
                'string',
                'required',
            ],
            'keterangan' => [
                'string',
                'nullable',
            ],
        ];
    }
}
