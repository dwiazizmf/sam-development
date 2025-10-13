<?php

namespace App\Http\Requests;

use App\Models\DetailDocumentClaim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDetailDocumentClaimRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('detail_document_claim_edit');
    }

    public function rules()
    {
        return [];
    }
}
