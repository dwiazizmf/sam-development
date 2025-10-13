<?php

namespace App\Http\Requests;

use App\Models\JenisRumahGedung;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJenisRumahGedungRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenis_rumah_gedung_create');
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
