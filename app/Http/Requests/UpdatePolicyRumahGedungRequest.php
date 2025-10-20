<?php

namespace App\Http\Requests;

use App\Models\PolicyRumahGedung;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyRumahGedungRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_rumah_gedung_edit');
    }

    public function rules()
    {
        return [
            'id_policies_id' => [
                'integer',
            ],
            'lokasi_pertanggungan' => [
                'string',
                'nullable',
            ],
            'nama_tertanggung' => [
                'string',
                'nullable',
            ],
            'ttl_tertanggung' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'alamat_tertanggung' => [
                'string',
                'nullable',
            ],
            'no_phone' => [
                'string',
                'nullable',
            ],
            'nama_paket' => [
                'string',
                'nullable',
            ],
            'upload_dokumen' => [
                'array',
            ],
        ];
    }
}
