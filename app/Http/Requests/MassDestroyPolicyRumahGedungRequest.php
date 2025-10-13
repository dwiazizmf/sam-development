<?php

namespace App\Http\Requests;

use App\Models\PolicyRumahGedung;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPolicyRumahGedungRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('policy_rumah_gedung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:policy_rumah_gedungs,id',
        ];
    }
}
