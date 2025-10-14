<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPoliciesCentralRequest;
use App\Http\Requests\StorePoliciesCentralRequest;
use App\Http\Requests\UpdatePoliciesCentralRequest;
use App\Models\ApiSyncLog;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\PoliciesCentral;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PoliciesCentralController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policies_central_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PoliciesCentral::with(['assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by'])->select(sprintf('%s.*', (new PoliciesCentral)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policies_central_show';
                $editGate      = 'policies_central_edit';
                $deleteGate    = 'policies_central_delete';
                $crudRoutePart = 'policies-centrals';

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
            $table->addColumn('assigned_to_customer_first_name', function ($row) {
                return $row->assigned_to_customer ? $row->assigned_to_customer->first_name : '';
            });

            $table->editColumn('policy_number', function ($row) {
                return $row->policy_number ? $row->policy_number : '';
            });
            $table->editColumn('policy_number_external', function ($row) {
                return $row->policy_number_external ? $row->policy_number_external : '';
            });
            $table->addColumn('insurance_product_product_name', function ($row) {
                return $row->insurance_product ? $row->insurance_product->product_name : '';
            });

            $table->editColumn('premium_amount', function ($row) {
                return $row->premium_amount ? $row->premium_amount : '';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('discount_total', function ($row) {
                return $row->discount_total ? $row->discount_total : '';
            });
            $table->editColumn('aksessoris_tambahan', function ($row) {
                return $row->aksessoris_tambahan ? $row->aksessoris_tambahan : '';
            });
            $table->editColumn('aksesoris_harga', function ($row) {
                return $row->aksesoris_harga ? $row->aksesoris_harga : '';
            });
            $table->editColumn('biaya_lainnya', function ($row) {
                return $row->biaya_lainnya ? $row->biaya_lainnya : '';
            });
            $table->editColumn('sum_insured', function ($row) {
                return $row->sum_insured ? $row->sum_insured : '';
            });
            $table->editColumn('policy_status', function ($row) {
                return $row->policy_status ? PoliciesCentral::POLICY_STATUS_SELECT[$row->policy_status] : '';
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? PoliciesCentral::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->editColumn('external_polis_doc', function ($row) {
                if (! $row->external_polis_doc) {
                    return '';
                }
                $links = [];
                foreach ($row->external_polis_doc as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('external_policy_system_name', function ($row) {
                return $row->external_policy ? $row->external_policy->system_name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'assigned_to_customer', 'insurance_product', 'external_polis_doc', 'assigned_to_user', 'external_policy', 'created_by']);

            return $table->make(true);
        }

        $crm_customers      = CrmCustomer::get();
        $insurance_products = InsuranceProduct::get();
        $users              = User::get();
        $api_sync_logs      = ApiSyncLog::get();

        return view('admin.policiesCentrals.index', compact('crm_customers', 'insurance_products', 'users', 'api_sync_logs'));
    }

    public function create()
    {
        abort_if(Gate::denies('policies_central_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $external_policies = ApiSyncLog::pluck('system_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.policiesCentrals.create', compact('assigned_to_customers', 'assigned_to_users', 'external_policies', 'insurance_products'));
    }

    public function store(StorePoliciesCentralRequest $request)
    {
        $policiesCentral = PoliciesCentral::create($request->all());

        foreach ($request->input('external_polis_doc', []) as $file) {
            $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $policiesCentral->id]);
        }

        return redirect()->route('admin.policies-centrals.index');
    }

    public function edit(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $external_policies = ApiSyncLog::pluck('system_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policiesCentral->load('assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by');

        return view('admin.policiesCentrals.edit', compact('assigned_to_customers', 'assigned_to_users', 'external_policies', 'insurance_products', 'policiesCentral'));
    }

    public function update(UpdatePoliciesCentralRequest $request, PoliciesCentral $policiesCentral)
    {
        $policiesCentral->update($request->all());

        if (count($policiesCentral->external_polis_doc) > 0) {
            foreach ($policiesCentral->external_polis_doc as $media) {
                if (! in_array($media->file_name, $request->input('external_polis_doc', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policiesCentral->external_polis_doc->pluck('file_name')->toArray();
        foreach ($request->input('external_polis_doc', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
            }
        }

        return redirect()->route('admin.policies-centrals.index');
    }

    public function show(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policiesCentral->load('assigned_to_customer', 'insurance_product', 'assigned_to_user', 'external_policy', 'created_by', 'policiesClaims', 'idPoliciesPolicyKesehatans', 'idPoliciesPolicyTravels', 'polisInvoices', 'idPoliciesPolicyMotors', 'idPoliciesPolicyPas', 'idPoliciesPolicyVehicles', 'idPoliciesPolicyRumahGedungs');

        return view('admin.policiesCentrals.show', compact('policiesCentral'));
    }

    public function destroy(PoliciesCentral $policiesCentral)
    {
        abort_if(Gate::denies('policies_central_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policiesCentral->delete();

        return back();
    }

    public function massDestroy(MassDestroyPoliciesCentralRequest $request)
    {
        $policiesCentrals = PoliciesCentral::find(request('ids'));

        foreach ($policiesCentrals as $policiesCentral) {
            $policiesCentral->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policies_central_create') && Gate::denies('policies_central_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PoliciesCentral();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
