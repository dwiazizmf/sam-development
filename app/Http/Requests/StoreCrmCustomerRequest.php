<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCrmCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_customer_create');
    }

    public function rules()
    {
        return [
            'company_id' => [
                'required',
                'integer',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
                'unique:crm_customers',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'commission' => [
                'numeric',
            ],
            'nama_pic' => [
                'string',
                'nullable',
            ],
            'no_telp_pic' => [
                'string',
                'nullable',
            ],
            'nama_bank_pic' => [
                'string',
                'nullable',
            ],
            'no_rekening_pic' => [
                'string',
                'nullable',
            ],
            'dokumen_legalitas' => [
                'array',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'converted_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
