<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDetailDocumentClaimRequest;
use App\Http\Requests\UpdateDetailDocumentClaimRequest;
use App\Http\Resources\Admin\DetailDocumentClaimResource;
use App\Models\DetailDocumentClaim;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetailDocumentClaimsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('detail_document_claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DetailDocumentClaimResource(DetailDocumentClaim::with(['insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'assigned_to_user', 'created_by'])->get());
    }

    public function store(StoreDetailDocumentClaimRequest $request)
    {
        $detailDocumentClaim = DetailDocumentClaim::create($request->all());

        if ($request->input('file_document_claim', false)) {
            $detailDocumentClaim->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_document_claim'))))->toMediaCollection('file_document_claim');
        }

        return (new DetailDocumentClaimResource($detailDocumentClaim))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DetailDocumentClaim $detailDocumentClaim)
    {
        abort_if(Gate::denies('detail_document_claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DetailDocumentClaimResource($detailDocumentClaim->load(['insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'assigned_to_user', 'created_by']));
    }

    public function update(UpdateDetailDocumentClaimRequest $request, DetailDocumentClaim $detailDocumentClaim)
    {
        $detailDocumentClaim->update($request->all());

        if ($request->input('file_document_claim', false)) {
            if (! $detailDocumentClaim->file_document_claim || $request->input('file_document_claim') !== $detailDocumentClaim->file_document_claim->file_name) {
                if ($detailDocumentClaim->file_document_claim) {
                    $detailDocumentClaim->file_document_claim->delete();
                }
                $detailDocumentClaim->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_document_claim'))))->toMediaCollection('file_document_claim');
            }
        } elseif ($detailDocumentClaim->file_document_claim) {
            $detailDocumentClaim->file_document_claim->delete();
        }

        return (new DetailDocumentClaimResource($detailDocumentClaim))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DetailDocumentClaim $detailDocumentClaim)
    {
        abort_if(Gate::denies('detail_document_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detailDocumentClaim->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
