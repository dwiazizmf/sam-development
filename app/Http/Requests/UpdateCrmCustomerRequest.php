<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCrmCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_customer_edit');
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
                'unique:crm_customers,email,' . request()->route('crm_customer')->id,
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
