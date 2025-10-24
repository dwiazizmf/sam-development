<?php

namespace App\Http\Requests;

use App\Models\PolicyVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePolicyVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_vehicle_create');
    }

    public function rules()
    {
        return [
            // 'id_policies_id' => [
            //     'required',
            //     'integer',
            // ],
            'merk_type' => [
                'string',
                'nullable',
            ],
            'warna_kendaraan' => [
                'string',
                'nullable',
            ],
            'tahun_pembuatan' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'no_polisi' => [
                'string',
                'nullable',
            ],
            'no_rangka' => [
                'string',
                'nullable',
            ],
            'no_mesin' => [
                'string',
                'nullable',
            ],
            'nama_tertanggung' => [
                'string',
                'nullable',
            ],
            'no_hp' => [
                'string',
                'nullable',
            ],
            'sertifikat_no' => [
                'string',
                'nullable',
            ],
            'upload_kendaraan' => [
                'array',
            ],
        ];
    }
}
