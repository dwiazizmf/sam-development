<?php

namespace App\Http\Requests;

use App\Models\StatusProspect;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStatusProspectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('status_prospect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:status_prospects,id',
        ];
    }
}
