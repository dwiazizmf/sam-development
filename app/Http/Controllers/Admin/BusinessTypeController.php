<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessTypeRequest;
use App\Http\Requests\StoreBusinessTypeRequest;
use App\Http\Requests\UpdateBusinessTypeRequest;
use App\Models\BusinessType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BusinessTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('business_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BusinessType::query()->select(sprintf('%s.*', (new BusinessType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'business_type_show';
                $editGate      = 'business_type_edit';
                $deleteGate    = 'business_type_delete';
                $crudRoutePart = 'business-types';

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

        return view('admin.businessTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('business_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessTypes.create');
    }

    public function store(StoreBusinessTypeRequest $request)
    {
        $businessType = BusinessType::create($request->all());

        return redirect()->route('admin.business-types.index');
    }

    public function edit(BusinessType $businessType)
    {
        abort_if(Gate::denies('business_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessTypes.edit', compact('businessType'));
    }

    public function update(UpdateBusinessTypeRequest $request, BusinessType $businessType)
    {
        $businessType->update($request->all());

        return redirect()->route('admin.business-types.index');
    }

    public function show(BusinessType $businessType)
    {
        abort_if(Gate::denies('business_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessTypes.show', compact('businessType'));
    }

    public function destroy(BusinessType $businessType)
    {
        abort_if(Gate::denies('business_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessTypeRequest $request)
    {
        $businessTypes = BusinessType::find(request('ids'));

        foreach ($businessTypes as $businessType) {
            $businessType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
