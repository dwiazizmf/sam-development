<?php

namespace App\Http\Requests;

use App\Models\PerluasanPertanggungan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPerluasanPertanggunganRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('perluasan_pertanggungan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:perluasan_pertanggungans,id',
        ];
    }
}
