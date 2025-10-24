<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPolicyTravelRequest;
use App\Http\Requests\StorePolicyTravelRequest;
use App\Http\Requests\UpdatePolicyTravelRequest;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\PoliciesCentral;
use App\Models\PolicyTravel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdatePolicyUnifiedRequest;
use App\Http\Requests\StorePolicyUnifiedRequest;
use App\Models\ApiSyncLog;
use Illuminate\Support\Facades\DB;

class PolicyTravelController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_travel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyTravel::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->select(sprintf('%s.*', (new PolicyTravel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_travel_show';
                $editGate      = 'policy_travel_edit';
                $deleteGate    = 'policy_travel_delete';
                $crudRoutePart = 'policy-travels';

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
            $table->addColumn('id_policies_policy_number', function ($row) {
                return $row->id_policies ? $row->id_policies->policy_number : '';
            });

            $table->editColumn('id_policies.premium_amount', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->premium_amount) : '';
            });
            $table->editColumn('id_policies.discount_total', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->discount_total) : '';
            });
            $table->editColumn('id_policies.sum_insured', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->sum_insured) : '';
            });
            $table->editColumn('id_policies.biaya_lainnya', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->biaya_lainnya) : '';
            });
            $table->editColumn('id_policies.start_date', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->start_date) : '';
            });
            $table->editColumn('id_policies.end_date', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->end_date) : '';
            });
            $table->addColumn('insurance_product_product_code', function ($row) {
                return $row->insurance_product ? $row->insurance_product->product_code : '';
            });

            $table->editColumn('insurance_product.product_name', function ($row) {
                return $row->insurance_product ? (is_string($row->insurance_product) ? $row->insurance_product : $row->insurance_product->product_name) : '';
            });
            $table->editColumn('polis_name', function ($row) {
                return $row->polis_name ? $row->polis_name : '';
            });
            $table->editColumn('policyholder_address', function ($row) {
                return $row->policyholder_address ? $row->policyholder_address : '';
            });
            $table->editColumn('jumlah_wisatawan', function ($row) {
                return $row->jumlah_wisatawan ? $row->jumlah_wisatawan : '';
            });
            $table->editColumn('asal_keberangkatan', function ($row) {
                return $row->asal_keberangkatan ? $row->asal_keberangkatan : '';
            });
            $table->editColumn('tujuan_keberangkatan', function ($row) {
                return $row->tujuan_keberangkatan ? $row->tujuan_keberangkatan : '';
            });
            $table->editColumn('nama_paket', function ($row) {
                return $row->nama_paket ? $row->nama_paket : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->editColumn('upload', function ($row) {
                if (! $row->upload) {
                    return '';
                }
                $links = [];
                foreach ($row->upload as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'id_policies', 'insurance_product', 'created_by', 'upload']);

            return $table->make(true);
        }

        $policies_centrals  = PoliciesCentral::get();
        $insurance_products = InsuranceProduct::get();
        $users              = User::get();
        $crm_customers      = CrmCustomer::get();

        return view('admin.policyTravels.index', compact('policies_centrals', 'insurance_products', 'users', 'crm_customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_travel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);

        return view('admin.policyTravels.create', compact('assigned_to_customers', 'assigned_to_users', 'insurance_products', 'isAdmin'));
    }

    public function store(StorePolicyUnifiedRequest $request, PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::beginTransaction();

            //insert ke central
            $policiesCentral = PoliciesCentral::create($request->centralData());
            foreach ($request->input('external_polis_doc', []) as $file) {
                $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $policiesCentral->id]);
            }

            // Insert ke child sesuai type
            $childData = $request->childData();
            $childData['id_policies_id'] = $policiesCentral->id;
            $policyTravel->create($childData);
            
            DB::commit(); // simpan semua perubahan

            return redirect()->route('admin.policy-travels.index');

        } catch (\Throwable $e) {
            DB::rollBack(); // batalkan semua kalau error

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);
        //$policyTravel->load('insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyTravels.edit', [
                                                    'policyTravel' => $policyTravel,
                                                    'policiesCentral' => $policyTravel->id_policies,
                                                    'assigned_to_customers' => $assigned_to_customers,
                                                    'assigned_to_users' => $assigned_to_users,
                                                    'insurance_products' => $insurance_products,
                                                    'isAdmin' => $isAdmin
                                                ]);
    }

    public function update(UpdatePolicyUnifiedRequest $request, PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::beginTransaction();
            // Insert ke tabel central
            $policiesCentral = $policyTravel->id_policies;
            $policiesCentral->update($request->centralData());
            // Insert ke child sesuai type
            $childData = $request->childData();
            $childData['id_policies_id'] = $policiesCentral->id;
            $policyTravel->update($childData);
           
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

            DB::commit();
            return redirect()->route('admin.policy-travels.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan polis', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show(PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyTravel->load('id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyTravels.show', compact('policyTravel'));
    }

    public function destroy(PolicyTravel $policyTravel)
    {
        abort_if(Gate::denies('policy_travel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyTravel->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyTravelRequest $request)
    {
        $policyTravels = PolicyTravel::find(request('ids'));

        foreach ($policyTravels as $policyTravel) {
            $policyTravel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policy_travel_create') && Gate::denies('policy_travel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PolicyTravel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
