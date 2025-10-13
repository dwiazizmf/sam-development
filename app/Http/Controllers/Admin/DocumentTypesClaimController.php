<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDocumentTypesClaimRequest;
use App\Http\Requests\StoreDocumentTypesClaimRequest;
use App\Http\Requests\UpdateDocumentTypesClaimRequest;
use App\Models\ClaimType;
use App\Models\ClaimTypeGroup;
use App\Models\DocumentTypesClaim;
use App\Models\InsuranceCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DocumentTypesClaimController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('document_types_claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DocumentTypesClaim::with(['insurance_company', 'claim_type_group', 'claim_type'])->select(sprintf('%s.*', (new DocumentTypesClaim)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'document_types_claim_show';
                $editGate      = 'document_types_claim_edit';
                $deleteGate    = 'document_types_claim_delete';
                $crudRoutePart = 'document-types-claims';

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
            $table->editColumn('document_code', function ($row) {
                return $row->document_code ? $row->document_code : '';
            });
            $table->editColumn('document_name', function ($row) {
                return $row->document_name ? $row->document_name : '';
            });
            $table->addColumn('insurance_company_company_name', function ($row) {
                return $row->insurance_company ? $row->insurance_company->company_name : '';
            });

            $table->addColumn('claim_type_group_claim_group_name', function ($row) {
                return $row->claim_type_group ? $row->claim_type_group->claim_group_name : '';
            });

            $table->addColumn('claim_type_claim_type_name', function ($row) {
                return $row->claim_type ? $row->claim_type->claim_type_name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('file_format_allowed', function ($row) {
                return $row->file_format_allowed ? $row->file_format_allowed : '';
            });
            $table->editColumn('max_file_size_mb', function ($row) {
                return $row->max_file_size_mb ? $row->max_file_size_mb : '';
            });
            $table->editColumn('is_image_only', function ($row) {
                return $row->is_image_only ? DocumentTypesClaim::IS_IMAGE_ONLY_SELECT[$row->is_image_only] : '';
            });
            $table->editColumn('require_original', function ($row) {
                return $row->require_original ? DocumentTypesClaim::REQUIRE_ORIGINAL_SELECT[$row->require_original] : '';
            });
            $table->editColumn('validation_rules', function ($row) {
                return $row->validation_rules ? $row->validation_rules : '';
            });
            $table->editColumn('sample_document_path', function ($row) {
                return $row->sample_document_path ? $row->sample_document_path : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'insurance_company', 'claim_type_group', 'claim_type']);

            return $table->make(true);
        }

        return view('admin.documentTypesClaims.index');
    }

    public function create()
    {
        abort_if(Gate::denies('document_types_claim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_type_groups = ClaimTypeGroup::pluck('claim_group_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documentTypesClaims.create', compact('claim_type_groups', 'claim_types', 'insurance_companies'));
    }

    public function store(StoreDocumentTypesClaimRequest $request)
    {
        $documentTypesClaim = DocumentTypesClaim::create($request->all());

        return redirect()->route('admin.document-types-claims.index');
    }

    public function edit(DocumentTypesClaim $documentTypesClaim)
    {
        abort_if(Gate::denies('document_types_claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_type_groups = ClaimTypeGroup::pluck('claim_group_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documentTypesClaim->load('insurance_company', 'claim_type_group', 'claim_type');

        return view('admin.documentTypesClaims.edit', compact('claim_type_groups', 'claim_types', 'documentTypesClaim', 'insurance_companies'));
    }

    public function update(UpdateDocumentTypesClaimRequest $request, DocumentTypesClaim $documentTypesClaim)
    {
        $documentTypesClaim->update($request->all());

        return redirect()->route('admin.document-types-claims.index');
    }

    public function show(DocumentTypesClaim $documentTypesClaim)
    {
        abort_if(Gate::denies('document_types_claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentTypesClaim->load('insurance_company', 'claim_type_group', 'claim_type');

        return view('admin.documentTypesClaims.show', compact('documentTypesClaim'));
    }

    public function destroy(DocumentTypesClaim $documentTypesClaim)
    {
        abort_if(Gate::denies('document_types_claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentTypesClaim->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentTypesClaimRequest $request)
    {
        $documentTypesClaims = DocumentTypesClaim::find(request('ids'));

        foreach ($documentTypesClaims as $documentTypesClaim) {
            $documentTypesClaim->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
