<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJenisPaketRequest;
use App\Http\Requests\StoreJenisPaketRequest;
use App\Http\Requests\UpdateJenisPaketRequest;
use App\Models\JenisPaket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JenisPaketController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('jenis_paket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JenisPaket::query()->select(sprintf('%s.*', (new JenisPaket)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'jenis_paket_show';
                $editGate      = 'jenis_paket_edit';
                $deleteGate    = 'jenis_paket_delete';
                $crudRoutePart = 'jenis-pakets';

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

        return view('admin.jenisPakets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_paket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPakets.create');
    }

    public function store(StoreJenisPaketRequest $request)
    {
        $jenisPaket = JenisPaket::create($request->all());

        return redirect()->route('admin.jenis-pakets.index');
    }

    public function edit(JenisPaket $jenisPaket)
    {
        abort_if(Gate::denies('jenis_paket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPakets.edit', compact('jenisPaket'));
    }

    public function update(UpdateJenisPaketRequest $request, JenisPaket $jenisPaket)
    {
        $jenisPaket->update($request->all());

        return redirect()->route('admin.jenis-pakets.index');
    }

    public function show(JenisPaket $jenisPaket)
    {
        abort_if(Gate::denies('jenis_paket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPakets.show', compact('jenisPaket'));
    }

    public function destroy(JenisPaket $jenisPaket)
    {
        abort_if(Gate::denies('jenis_paket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPaket->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisPaketRequest $request)
    {
        $jenisPakets = JenisPaket::find(request('ids'));

        foreach ($jenisPakets as $jenisPaket) {
            $jenisPaket->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
