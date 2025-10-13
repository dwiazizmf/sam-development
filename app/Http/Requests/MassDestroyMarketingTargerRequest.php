<?php

namespace App\Http\Requests;

use App\Models\MarketingTarger;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMarketingTargerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('marketing_targer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:marketing_targers,id',
        ];
    }
}
