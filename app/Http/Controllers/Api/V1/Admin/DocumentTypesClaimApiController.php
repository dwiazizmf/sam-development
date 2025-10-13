<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentTypesClaimRequest;
use App\Http\Requests\UpdateDocumentTypesClaimRequest;
use App\Http\Resources\Admin\DocumentTypesClaimResource;
use App\Models\DocumentTypesClaim;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentTypesClaimApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('document_types_claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentTypesClaimResource(DocumentTypesClaim::with(['insurance_company', 'claim_type_group', 'claim_type'])->get());
    }

    public function store(StoreDocumentTypesClaimRequest $request)
    {
        $documentTypesClaim = DocumentTypesClaim::create($request->all());

        return (new DocumentTypesClaimResource($documentTypesClaim))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DocumentTypesClaim $documentTypesClaim)
    {
        abort_if(Gate::denies('document_types_claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentTypesClaimResource($documentTypesClaim->load(['insurance_company', 'claim_type_group', 'claim_type']));
    }

    public function update(UpdateDocumentTypesClaimRequest $request, DocumentTypesClaim $documentTypesClaim)
    {
        $documentTypesClaim->update($request->all());

        return (new DocumentTypesClaimResource($documentTypesClaim))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DocumentTypesClaim $documentTypesClaim)
    {
        abort_if(Gate::denies('document_types_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentTypesClaim->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
