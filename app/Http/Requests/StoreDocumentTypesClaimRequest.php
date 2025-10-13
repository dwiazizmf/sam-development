<?php

namespace App\Http\Requests;

use App\Models\DocumentTypesClaim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDocumentTypesClaimRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('document_types_claim_create');
    }

    public function rules()
    {
        return [
            'document_code' => [
                'string',
                'nullable',
            ],
            'document_name' => [
                'string',
                'required',
            ],
            'insurance_company_id' => [
                'required',
                'integer',
            ],
            'file_format_allowed' => [
                'string',
                'required',
            ],
            'max_file_size_mb' => [
                'numeric',
            ],
            'is_image_only' => [
                'required',
            ],
            'require_original' => [
                'required',
            ],
            'sample_document_path' => [
                'string',
                'nullable',
            ],
        ];
    }
}
