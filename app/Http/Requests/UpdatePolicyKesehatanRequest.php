<?php

namespace App\Http\Requests;

use App\Models\PolicyKesehatan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyKesehatanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_kesehatan_edit');
    }

    public function rules()
    {
        return [
            'id_policies_id' => [
                'integer',
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
            'phone' => [
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
            'assigned_to_user_id' => [
                'integer',
            ],
            'assigned_to_customer_id' => [
                'integer',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'insurance_product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
