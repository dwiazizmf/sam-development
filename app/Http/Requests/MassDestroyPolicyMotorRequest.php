<?php

namespace App\Http\Requests;

use App\Models\PolicyMotor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPolicyMotorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('policy_motor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:policy_motors,id',
        ];
    }
}
