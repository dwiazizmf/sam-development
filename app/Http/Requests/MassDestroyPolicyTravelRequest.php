<?php

namespace App\Http\Requests;

use App\Models\PolicyTravel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPolicyTravelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('policy_travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:policy_travels,id',
        ];
    }
}
