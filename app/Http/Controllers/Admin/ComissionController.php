<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Comission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComissionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comission::with(['assigned_to_users', 'from_users', 'polis_transactions', 'created_by'])->select(sprintf('%s.*', (new Comission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'comission_show';
                $editGate      = 'comission_edit';
                $deleteGate    = 'comission_delete';
                $crudRoutePart = 'comissions';

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
            $table->editColumn('assigned_to_user', function ($row) {
                $labels = [];
                foreach ($row->assigned_to_users as $assigned_to_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $assigned_to_user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('from_user', function ($row) {
                $labels = [];
                foreach ($row->from_users as $from_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $from_user->first_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('polis_transaction', function ($row) {
                $labels = [];
                foreach ($row->polis_transactions as $polis_transaction) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $polis_transaction->policy_number);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('level', function ($row) {
                return $row->level ? $row->level : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'assigned_to_user', 'from_user', 'polis_transaction']);

            return $table->make(true);
        }

        return view('admin.comissions.index');
    }

    public function show(Comission $comission)
    {
        abort_if(Gate::denies('comission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comission->load('assigned_to_users', 'from_users', 'polis_transactions', 'created_by');

        return view('admin.comissions.show', compact('comission'));
    }
}
