<?php

namespace App\Http\Requests;

use App\Models\InsuranceCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInsuranceCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('insurance_company_edit');
    }

    public function rules()
    {
        return [
            'company_code' => [
                'string',
                'nullable',
            ],
            'company_name' => [
                'string',
                'required',
            ],
            'company_short_name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'address' => [
                'required',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'province' => [
                'string',
                'nullable',
            ],
            'postal_code' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'contact_person' => [
                'string',
                'required',
            ],
            'contact_position' => [
                'string',
                'required',
            ],
            'contact_phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
