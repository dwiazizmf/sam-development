<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClaimRequest;
use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Models\Claim;
use App\Models\ClaimType;
use App\Models\PoliciesCentral;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClaimsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Claim::with(['policies', 'claim_type', 'reviewed_by_user', 'assigned_to_user', 'created_by'])->select(sprintf('%s.*', (new Claim)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'claim_show';
                $editGate      = 'claim_edit';
                $deleteGate    = 'claim_delete';
                $crudRoutePart = 'claims';

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
            $table->editColumn('claim_number', function ($row) {
                return $row->claim_number ? $row->claim_number : '';
            });
            $table->addColumn('policies_policy_number', function ($row) {
                return $row->policies ? $row->policies->policy_number : '';
            });

            $table->addColumn('claim_type_claim_type_name', function ($row) {
                return $row->claim_type ? $row->claim_type->claim_type_name : '';
            });

            $table->editColumn('claim_status', function ($row) {
                return $row->claim_status ? Claim::CLAIM_STATUS_SELECT[$row->claim_status] : '';
            });
            $table->addColumn('reviewed_by_user_name', function ($row) {
                return $row->reviewed_by_user ? $row->reviewed_by_user->name : '';
            });

            $table->editColumn('review_notes', function ($row) {
                return $row->review_notes ? $row->review_notes : '';
            });
            $table->editColumn('approved_amount', function ($row) {
                return $row->approved_amount ? $row->approved_amount : '';
            });

            $table->editColumn('payment_reference', function ($row) {
                return $row->payment_reference ? $row->payment_reference : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? $row->payment_method : '';
            });
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'policies', 'claim_type', 'reviewed_by_user', 'assigned_to_user', 'created_by']);

            return $table->make(true);
        }

        $policies_centrals = PoliciesCentral::get();
        $claim_types       = ClaimType::get();
        $users             = User::get();

        return view('admin.claims.index', compact('policies_centrals', 'claim_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('claim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policies = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reviewed_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.claims.create', compact('assigned_to_users', 'claim_types', 'policies', 'reviewed_by_users'));
    }

    public function store(StoreClaimRequest $request)
    {
        $claim = Claim::create($request->all());

        return redirect()->route('admin.claims.index');
    }

    public function edit(Claim $claim)
    {
        abort_if(Gate::denies('claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policies = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim_types = ClaimType::pluck('claim_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reviewed_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim->load('policies', 'claim_type', 'reviewed_by_user', 'assigned_to_user', 'created_by');

        return view('admin.claims.edit', compact('assigned_to_users', 'claim', 'claim_types', 'policies', 'reviewed_by_users'));
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $claim->update($request->all());

        return redirect()->route('admin.claims.index');
    }

    public function show(Claim $claim)
    {
        abort_if(Gate::denies('claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->load('policies', 'claim_type', 'reviewed_by_user', 'assigned_to_user', 'created_by', 'claimsDetailDocumentClaims');

        return view('admin.claims.show', compact('claim'));
    }

    public function destroy(Claim $claim)
    {
        abort_if(Gate::denies('claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->delete();

        return back();
    }

    public function massDestroy(MassDestroyClaimRequest $request)
    {
        $claims = Claim::find(request('ids'));

        foreach ($claims as $claim) {
            $claim->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
