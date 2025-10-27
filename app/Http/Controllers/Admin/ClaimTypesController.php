<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClaimTypeRequest;
use App\Http\Requests\StoreClaimTypeRequest;
use App\Http\Requests\UpdateClaimTypeRequest;
use App\Models\ClaimType;
use App\Models\ClaimTypeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClaimTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('claim_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClaimType::with(['claim_gorup'])->select(sprintf('%s.*', (new ClaimType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'claim_type_show';
                $editGate      = 'claim_type_edit';
                $deleteGate    = 'claim_type_delete';
                $crudRoutePart = 'claim-types';

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
            $table->addColumn('claim_gorup_claim_group_code', function ($row) {
                return $row->claim_gorup ? $row->claim_gorup->claim_group_code : '';
            });

            $table->editColumn('claim_gorup.claim_group_name', function ($row) {
                return $row->claim_gorup ? (is_string($row->claim_gorup) ? $row->claim_gorup : $row->claim_gorup->claim_group_name) : '';
            });

            $table->editColumn('claim_type_code', function ($row) {
                return $row->claim_type_code ? ClaimType::CLAIM_COVERAGE[$row->claim_type_code] : '';
            });
            
            // $table->editColumn('claim_type_code', function ($row) {
            //     return $row->claim_type_code ? $row->claim_type_code : '';
            // });
            
            $table->editColumn('claim_type_name', function ($row) {
                return $row->claim_type_name ? $row->claim_type_name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('max_claim_amount', function ($row) {
                return $row->max_claim_amount ? $row->max_claim_amount : '';
            });
            $table->editColumn('processing_time_days', function ($row) {
                return $row->processing_time_days ? $row->processing_time_days : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'claim_gorup']);

            return $table->make(true);
        }

        return view('admin.claimTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('claim_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim_gorups = ClaimTypeGroup::pluck('claim_group_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.claimTypes.create', compact('claim_gorups'));
    }

    public function store(StoreClaimTypeRequest $request)
    {
        $claimType = ClaimType::create($request->all());

        return redirect()->route('admin.claim-types.index');
    }

    public function edit(ClaimType $claimType)
    {
        abort_if(Gate::denies('claim_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim_gorups = ClaimTypeGroup::pluck('claim_group_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claimType->load('claim_gorup');

        return view('admin.claimTypes.edit', compact('claimType', 'claim_gorups'));
    }

    public function update(UpdateClaimTypeRequest $request, ClaimType $claimType)
    {
        $claimType->update($request->all());

        return redirect()->route('admin.claim-types.index');
    }

    public function show(ClaimType $claimType)
    {
        abort_if(Gate::denies('claim_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimType->load('claim_gorup');

        return view('admin.claimTypes.show', compact('claimType'));
    }

    public function destroy(ClaimType $claimType)
    {
        abort_if(Gate::denies('claim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimType->delete();

        return back();
    }

    public function massDestroy(MassDestroyClaimTypeRequest $request)
    {
        $claimTypes = ClaimType::find(request('ids'));

        foreach ($claimTypes as $claimType) {
            $claimType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
