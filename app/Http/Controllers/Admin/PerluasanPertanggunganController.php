<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPerluasanPertanggunganRequest;
use App\Http\Requests\StorePerluasanPertanggunganRequest;
use App\Http\Requests\UpdatePerluasanPertanggunganRequest;
use App\Models\PerluasanPertanggungan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PerluasanPertanggunganController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('perluasan_pertanggungan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PerluasanPertanggungan::query()->select(sprintf('%s.*', (new PerluasanPertanggungan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'perluasan_pertanggungan_show';
                $editGate      = 'perluasan_pertanggungan_edit';
                $deleteGate    = 'perluasan_pertanggungan_delete';
                $crudRoutePart = 'perluasan-pertanggungans';

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
            $table->editColumn('pertanggungan_name', function ($row) {
                return $row->pertanggungan_name ? $row->pertanggungan_name : '';
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.perluasanPertanggungans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('perluasan_pertanggungan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.perluasanPertanggungans.create');
    }

    public function store(StorePerluasanPertanggunganRequest $request)
    {
        $perluasanPertanggungan = PerluasanPertanggungan::create($request->all());

        return redirect()->route('admin.perluasan-pertanggungans.index');
    }

    public function edit(PerluasanPertanggungan $perluasanPertanggungan)
    {
        abort_if(Gate::denies('perluasan_pertanggungan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.perluasanPertanggungans.edit', compact('perluasanPertanggungan'));
    }

    public function update(UpdatePerluasanPertanggunganRequest $request, PerluasanPertanggungan $perluasanPertanggungan)
    {
        $perluasanPertanggungan->update($request->all());

        return redirect()->route('admin.perluasan-pertanggungans.index');
    }

    public function show(PerluasanPertanggungan $perluasanPertanggungan)
    {
        abort_if(Gate::denies('perluasan_pertanggungan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.perluasanPertanggungans.show', compact('perluasanPertanggungan'));
    }

    public function destroy(PerluasanPertanggungan $perluasanPertanggungan)
    {
        abort_if(Gate::denies('perluasan_pertanggungan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perluasanPertanggungan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPerluasanPertanggunganRequest $request)
    {
        $perluasanPertanggungans = PerluasanPertanggungan::find(request('ids'));

        foreach ($perluasanPertanggungans as $perluasanPertanggungan) {
            $perluasanPertanggungan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
