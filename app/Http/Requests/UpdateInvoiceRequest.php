<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_edit');
    }

    public function rules()
    {
        return [
            'polis_id' => [
                'required',
                'integer',
            ],
            'invoice_number' => [
                'string',
                'nullable',
            ],
            'due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'paid_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'payment_method' => [
                'string',
                'nullable',
            ],
            'reference_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
