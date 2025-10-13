<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClaimTypeGroupRequest;
use App\Http\Requests\StoreClaimTypeGroupRequest;
use App\Http\Requests\UpdateClaimTypeGroupRequest;
use App\Models\ClaimTypeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClaimTypeGroupController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('claim_type_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClaimTypeGroup::query()->select(sprintf('%s.*', (new ClaimTypeGroup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'claim_type_group_show';
                $editGate      = 'claim_type_group_edit';
                $deleteGate    = 'claim_type_group_delete';
                $crudRoutePart = 'claim-type-groups';

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
            $table->editColumn('claim_group_code', function ($row) {
                return $row->claim_group_code ? $row->claim_group_code : '';
            });
            $table->editColumn('claim_group_name', function ($row) {
                return $row->claim_group_name ? $row->claim_group_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.claimTypeGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('claim_type_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.claimTypeGroups.create');
    }

    public function store(StoreClaimTypeGroupRequest $request)
    {
        $claimTypeGroup = ClaimTypeGroup::create($request->all());

        return redirect()->route('admin.claim-type-groups.index');
    }

    public function edit(ClaimTypeGroup $claimTypeGroup)
    {
        abort_if(Gate::denies('claim_type_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.claimTypeGroups.edit', compact('claimTypeGroup'));
    }

    public function update(UpdateClaimTypeGroupRequest $request, ClaimTypeGroup $claimTypeGroup)
    {
        $claimTypeGroup->update($request->all());

        return redirect()->route('admin.claim-type-groups.index');
    }

    public function show(ClaimTypeGroup $claimTypeGroup)
    {
        abort_if(Gate::denies('claim_type_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimTypeGroup->load('claimGorupClaimTypes');

        return view('admin.claimTypeGroups.show', compact('claimTypeGroup'));
    }

    public function destroy(ClaimTypeGroup $claimTypeGroup)
    {
        abort_if(Gate::denies('claim_type_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claimTypeGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyClaimTypeGroupRequest $request)
    {
        $claimTypeGroups = ClaimTypeGroup::find(request('ids'));

        foreach ($claimTypeGroups as $claimTypeGroup) {
            $claimTypeGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
