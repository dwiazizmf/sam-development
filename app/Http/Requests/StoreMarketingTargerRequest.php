<?php

namespace App\Http\Requests;

use App\Models\MarketingTarger;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMarketingTargerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marketing_targer_create');
    }

    public function rules()
    {
        return [
            'target_year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'target_month' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'new_prospects_target' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'conversion_target' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'revenue_target' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'policies_target' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'followup_frequency_target' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'new_prospects_achieved' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'conversion_achieved' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'revenue_achieved' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'policies_achieved' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'followup_frequency_achieved' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
