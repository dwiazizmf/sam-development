<?php

namespace App\Http\Requests;

use App\Models\JenisPertanggungan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJenisPertanggunganRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('jenis_pertanggungan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:jenis_pertanggungans,id',
        ];
    }
}
