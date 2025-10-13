<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJenisRumahGedungRequest;
use App\Http\Requests\StoreJenisRumahGedungRequest;
use App\Http\Requests\UpdateJenisRumahGedungRequest;
use App\Models\JenisRumahGedung;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JenisRumahGedungController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('jenis_rumah_gedung_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JenisRumahGedung::query()->select(sprintf('%s.*', (new JenisRumahGedung)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'jenis_rumah_gedung_show';
                $editGate      = 'jenis_rumah_gedung_edit';
                $deleteGate    = 'jenis_rumah_gedung_delete';
                $crudRoutePart = 'jenis-rumah-gedungs';

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

        return view('admin.jenisRumahGedungs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_rumah_gedung_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisRumahGedungs.create');
    }

    public function store(StoreJenisRumahGedungRequest $request)
    {
        $jenisRumahGedung = JenisRumahGedung::create($request->all());

        return redirect()->route('admin.jenis-rumah-gedungs.index');
    }

    public function edit(JenisRumahGedung $jenisRumahGedung)
    {
        abort_if(Gate::denies('jenis_rumah_gedung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisRumahGedungs.edit', compact('jenisRumahGedung'));
    }

    public function update(UpdateJenisRumahGedungRequest $request, JenisRumahGedung $jenisRumahGedung)
    {
        $jenisRumahGedung->update($request->all());

        return redirect()->route('admin.jenis-rumah-gedungs.index');
    }

    public function show(JenisRumahGedung $jenisRumahGedung)
    {
        abort_if(Gate::denies('jenis_rumah_gedung_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisRumahGedungs.show', compact('jenisRumahGedung'));
    }

    public function destroy(JenisRumahGedung $jenisRumahGedung)
    {
        abort_if(Gate::denies('jenis_rumah_gedung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisRumahGedung->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisRumahGedungRequest $request)
    {
        $jenisRumahGedungs = JenisRumahGedung::find(request('ids'));

        foreach ($jenisRumahGedungs as $jenisRumahGedung) {
            $jenisRumahGedung->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
