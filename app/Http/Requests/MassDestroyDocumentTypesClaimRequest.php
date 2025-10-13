<?php

namespace App\Http\Requests;

use App\Models\DocumentTypesClaim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDocumentTypesClaimRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('document_types_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:document_types_claims,id',
        ];
    }
}
