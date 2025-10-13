<?php

namespace App\Http\Requests;

use App\Models\PoliciesCentral;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPoliciesCentralRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('policies_central_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:policies_centrals,id',
        ];
    }
}
