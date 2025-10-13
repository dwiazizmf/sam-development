<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJenisPertanggunganRequest;
use App\Http\Requests\StoreJenisPertanggunganRequest;
use App\Http\Requests\UpdateJenisPertanggunganRequest;
use App\Models\JenisPertanggungan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JenisPertanggunganController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('jenis_pertanggungan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JenisPertanggungan::query()->select(sprintf('%s.*', (new JenisPertanggungan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'jenis_pertanggungan_show';
                $editGate      = 'jenis_pertanggungan_edit';
                $deleteGate    = 'jenis_pertanggungan_delete';
                $crudRoutePart = 'jenis-pertanggungans';

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
            $table->editColumn('jenis_name', function ($row) {
                return $row->jenis_name ? $row->jenis_name : '';
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.jenisPertanggungans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_pertanggungan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPertanggungans.create');
    }

    public function store(StoreJenisPertanggunganRequest $request)
    {
        $jenisPertanggungan = JenisPertanggungan::create($request->all());

        return redirect()->route('admin.jenis-pertanggungans.index');
    }

    public function edit(JenisPertanggungan $jenisPertanggungan)
    {
        abort_if(Gate::denies('jenis_pertanggungan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPertanggungans.edit', compact('jenisPertanggungan'));
    }

    public function update(UpdateJenisPertanggunganRequest $request, JenisPertanggungan $jenisPertanggungan)
    {
        $jenisPertanggungan->update($request->all());

        return redirect()->route('admin.jenis-pertanggungans.index');
    }

    public function show(JenisPertanggungan $jenisPertanggungan)
    {
        abort_if(Gate::denies('jenis_pertanggungan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisPertanggungans.show', compact('jenisPertanggungan'));
    }

    public function destroy(JenisPertanggungan $jenisPertanggungan)
    {
        abort_if(Gate::denies('jenis_pertanggungan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPertanggungan->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisPertanggunganRequest $request)
    {
        $jenisPertanggungans = JenisPertanggungan::find(request('ids'));

        foreach ($jenisPertanggungans as $jenisPertanggungan) {
            $jenisPertanggungan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
