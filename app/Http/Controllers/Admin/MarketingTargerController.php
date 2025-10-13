<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMarketingTargerRequest;
use App\Http\Requests\StoreMarketingTargerRequest;
use App\Http\Requests\UpdateMarketingTargerRequest;
use App\Models\MarketingTarger;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MarketingTargerController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('marketing_targer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MarketingTarger::with(['assigned_to_user', 'created_by'])->select(sprintf('%s.*', (new MarketingTarger)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'marketing_targer_show';
                $editGate      = 'marketing_targer_edit';
                $deleteGate    = 'marketing_targer_delete';
                $crudRoutePart = 'marketing-targers';

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
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->editColumn('target_year', function ($row) {
                return $row->target_year ? $row->target_year : '';
            });
            $table->editColumn('target_month', function ($row) {
                return $row->target_month ? $row->target_month : '';
            });
            $table->editColumn('new_prospects_target', function ($row) {
                return $row->new_prospects_target ? $row->new_prospects_target : '';
            });
            $table->editColumn('conversion_target', function ($row) {
                return $row->conversion_target ? $row->conversion_target : '';
            });
            $table->editColumn('revenue_target', function ($row) {
                return $row->revenue_target ? $row->revenue_target : '';
            });
            $table->editColumn('policies_target', function ($row) {
                return $row->policies_target ? $row->policies_target : '';
            });
            $table->editColumn('followup_frequency_target', function ($row) {
                return $row->followup_frequency_target ? $row->followup_frequency_target : '';
            });
            $table->editColumn('new_prospects_achieved', function ($row) {
                return $row->new_prospects_achieved ? $row->new_prospects_achieved : '';
            });
            $table->editColumn('conversion_achieved', function ($row) {
                return $row->conversion_achieved ? $row->conversion_achieved : '';
            });
            $table->editColumn('revenue_achieved', function ($row) {
                return $row->revenue_achieved ? $row->revenue_achieved : '';
            });
            $table->editColumn('policies_achieved', function ($row) {
                return $row->policies_achieved ? $row->policies_achieved : '';
            });
            $table->editColumn('followup_frequency_achieved', function ($row) {
                return $row->followup_frequency_achieved ? $row->followup_frequency_achieved : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'assigned_to_user', 'created_by']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.marketingTargers.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('marketing_targer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.marketingTargers.create', compact('assigned_to_users'));
    }

    public function store(StoreMarketingTargerRequest $request)
    {
        $marketingTarger = MarketingTarger::create($request->all());

        return redirect()->route('admin.marketing-targers.index');
    }

    public function edit(MarketingTarger $marketingTarger)
    {
        abort_if(Gate::denies('marketing_targer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marketingTarger->load('assigned_to_user', 'created_by');

        return view('admin.marketingTargers.edit', compact('assigned_to_users', 'marketingTarger'));
    }

    public function update(UpdateMarketingTargerRequest $request, MarketingTarger $marketingTarger)
    {
        $marketingTarger->update($request->all());

        return redirect()->route('admin.marketing-targers.index');
    }

    public function show(MarketingTarger $marketingTarger)
    {
        abort_if(Gate::denies('marketing_targer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingTarger->load('assigned_to_user', 'created_by');

        return view('admin.marketingTargers.show', compact('marketingTarger'));
    }

    public function destroy(MarketingTarger $marketingTarger)
    {
        abort_if(Gate::denies('marketing_targer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingTarger->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarketingTargerRequest $request)
    {
        $marketingTargers = MarketingTarger::find(request('ids'));

        foreach ($marketingTargers as $marketingTarger) {
            $marketingTarger->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
