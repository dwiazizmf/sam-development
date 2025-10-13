<?php

namespace App\Http\Requests;

use App\Models\PerluasanPertanggungan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePerluasanPertanggunganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('perluasan_pertanggungan_edit');
    }

    public function rules()
    {
        return [
            'pertanggungan_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
