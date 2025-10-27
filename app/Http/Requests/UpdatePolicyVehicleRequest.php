<?php

namespace App\Http\Requests;

use App\Models\PolicyVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_vehicle_edit');
    }

    public function rules()
    {
        return [
            'id_policies_id' => [
                'integer',
            ],
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
            'alamat_tertanggung' => [
                'string',
                'nullable',
                'max:255',
            ],
            'email' => [
                'nullable', 
                'string', 
                'email', 
                'max:255'
            ],
            'nilai_pertanggungan' => [
                'integer',
                'nullable',
            ],
            'jenis_pertanggungan_id' => [
                'required',
                'nullable',
            ],
            'perluasan_pertanggungan_id' => [
                'required',
                'nullable',
            ],
            // 'assigned_to_user_id' => [
            //     'integer',
            // ],
             'assigned_to_customer_id' => [
                'integer',
            ],
        ];
    }
}
