<?php

namespace App\Http\Requests;

use App\Models\DetailDocumentClaim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDetailDocumentClaimRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('detail_document_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:detail_document_claims,id',
        ];
    }
}
