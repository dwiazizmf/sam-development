<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDetailDocumentClaimRequest;
use App\Http\Requests\StoreDetailDocumentClaimRequest;
use App\Http\Requests\UpdateDetailDocumentClaimRequest;
use App\Models\Claim;
use App\Models\ClaimType;
use App\Models\DetailDocumentClaim;
use App\Models\InsuranceCompany;
use App\Models\InsuranceProduct;
use App\Models\PoliciesCentral;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DetailDocumentClaimsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('detail_document_claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DetailDocumentClaim::with(['insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'assigned_to_user', 'created_by'])->select(sprintf('%s.*', (new DetailDocumentClaim)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'detail_document_claim_show';
                $editGate      = 'detail_document_claim_edit';
                $deleteGate    = 'detail_document_claim_delete';
                $crudRoutePart = 'detail-document-claims';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('insurance_company_company_code', function ($row) {
                return $row->insurance_company ? $row->insurance_company->company_code : '';
            });

            $table->editColumn('insurance_company.company_name', function ($row) {
                return $row->insurance_company ? (is_string($row->insurance_company) ? $row->insurance_company : $row->insurance_company->company_name) : '';
            });
            $table->addColumn('insurance_product_product_code', function ($row) {
                return $row->insurance_product ? $row->insurance_product->product_code : '';
            });

            $table->editColumn('insurance_product.product_name', function ($row) {
                return $row->insurance_product ? (is_string($row->insurance_product) ? $row->insurance_product : $row->insurance_product->product_name) : '';
            });
            $table->addColumn('policies_data_policy_number', function ($row) {
                return $row->policies_data ? $row->policies_data->policy_number : '';
            });

            $table->addColumn('claim_type_claim_type_name', function ($row) {
                return $row->claim_type ? $row->claim_type->claim_type_name : '';
            });

            $table->addColumn('claims_claim_number', function ($row) {
                return $row->claims ? $row->claims->claim_number : '';
            });

            $table->editColumn('file_document_claim', function ($row) {
                return $row->file_document_claim ? '<a href="' . $row->file_document_claim->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'file_document_claim', 'assigned_to_user', 'created_by']);

            return $table->make(true);
        }

        return view('admin.detailDocumentClaims.index');
    }

    public function create()
    {
        abort_if(Gate::denies('detail_document_claim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies_datas = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claims = Claim::pluck('claim_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.detailDocumentClaims.create', compact('assigned_to_users', 'claim_types', 'claims', 'insurance_companies', 'insurance_products', 'policies_datas'));
    }

    public function store(StoreDetailDocumentClaimRequest $request)
    {
        $detailDocumentClaim = DetailDocumentClaim::create($request->all());

        if ($request->input('file_document_claim', false)) {
            $detailDocumentClaim->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_document_claim'))))->toMediaCollection('file_document_claim');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $detailDocumentClaim->id]);
        }

        return redirect()->route('admin.detail-document-claims.index');
    }

    public function edit(DetailDocumentClaim $detailDocumentClaim)
    {
        abort_if(Gate::denies('detail_document_claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies_datas = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claims = Claim::pluck('claim_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $detailDocumentClaim->load('insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'assigned_to_user', 'created_by');

        return view('admin.detailDocumentClaims.edit', compact('assigned_to_users', 'claim_types', 'claims', 'detailDocumentClaim', 'insurance_companies', 'insurance_products', 'policies_datas'));
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

        return redirect()->route('admin.detail-document-claims.index');
    }

    public function show(DetailDocumentClaim $detailDocumentClaim)
    {
        abort_if(Gate::denies('detail_document_claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detailDocumentClaim->load('insurance_company', 'insurance_product', 'policies_data', 'claim_type', 'claims', 'assigned_to_user', 'created_by');

        return view('admin.detailDocumentClaims.show', compact('detailDocumentClaim'));
    }

    public function destroy(DetailDocumentClaim $detailDocumentClaim)
    {
        abort_if(Gate::denies('detail_document_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detailDocumentClaim->delete();

        return back();
    }

    public function massDestroy(MassDestroyDetailDocumentClaimRequest $request)
    {
        $detailDocumentClaims = DetailDocumentClaim::find(request('ids'));

        foreach ($detailDocumentClaims as $detailDocumentClaim) {
            $detailDocumentClaim->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('detail_document_claim_create') && Gate::denies('detail_document_claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DetailDocumentClaim();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
