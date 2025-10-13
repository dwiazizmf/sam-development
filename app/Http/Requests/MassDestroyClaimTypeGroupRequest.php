<?php

namespace App\Http\Requests;

use App\Models\ClaimTypeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClaimTypeGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('claim_type_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:claim_type_groups,id',
        ];
    }
}
