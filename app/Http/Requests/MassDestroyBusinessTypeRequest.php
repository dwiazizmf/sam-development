<?php

namespace App\Http\Requests;

use App\Models\BusinessType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_types,id',
        ];
    }
}
