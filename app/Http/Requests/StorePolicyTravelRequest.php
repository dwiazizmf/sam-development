<?php

namespace App\Http\Requests;

use App\Models\PolicyTravel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePolicyTravelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_travel_create');
    }

    public function rules()
    {
        return [
            // 'id_policies_id' => [
            //     'required',
            //     'integer',
            // ],
            'polis_name' => [
                'string',
                'required',
            ],
            'policyholder_address' => [
                'required',
            ],
            'jumlah_wisatawan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'asal_keberangkatan' => [
                'string',
                'nullable',
            ],
            'tujuan_keberangkatan' => [
                'string',
                'nullable',
            ],
            'nama_paket' => [
                'string',
                'nullable',
            ],
            'upload' => [
                'array',
            ],
            'assigned_to_user_id' => [
                'integer',
            ],
            'assigned_to_customer_id' => [
                'integer',
            ],
            'insurance_product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
