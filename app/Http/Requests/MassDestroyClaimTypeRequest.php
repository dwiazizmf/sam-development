<?php

namespace App\Http\Requests;

use App\Models\ClaimType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClaimTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('claim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:claim_types,id',
        ];
    }
}
