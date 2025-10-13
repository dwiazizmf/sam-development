<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStatusProspectRequest;
use App\Http\Requests\StoreStatusProspectRequest;
use App\Http\Requests\UpdateStatusProspectRequest;
use App\Models\StatusProspect;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StatusProspectController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('status_prospect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StatusProspect::query()->select(sprintf('%s.*', (new StatusProspect)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'status_prospect_show';
                $editGate      = 'status_prospect_edit';
                $deleteGate    = 'status_prospect_delete';
                $crudRoutePart = 'status-prospects';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.statusProspects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('status_prospect_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusProspects.create');
    }

    public function store(StoreStatusProspectRequest $request)
    {
        $statusProspect = StatusProspect::create($request->all());

        return redirect()->route('admin.status-prospects.index');
    }

    public function edit(StatusProspect $statusProspect)
    {
        abort_if(Gate::denies('status_prospect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusProspects.edit', compact('statusProspect'));
    }

    public function update(UpdateStatusProspectRequest $request, StatusProspect $statusProspect)
    {
        $statusProspect->update($request->all());

        return redirect()->route('admin.status-prospects.index');
    }

    public function show(StatusProspect $statusProspect)
    {
        abort_if(Gate::denies('status_prospect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statusProspects.show', compact('statusProspect'));
    }

    public function destroy(StatusProspect $statusProspect)
    {
        abort_if(Gate::denies('status_prospect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statusProspect->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatusProspectRequest $request)
    {
        $statusProspects = StatusProspect::find(request('ids'));

        foreach ($statusProspects as $statusProspect) {
            $statusProspect->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
