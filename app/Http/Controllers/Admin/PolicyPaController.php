<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPolicyPaRequest;
use App\Http\Requests\StorePolicyPaRequest;
use App\Http\Requests\UpdatePolicyPaRequest;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\PoliciesCentral;
use App\Models\PolicyPa;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PolicyPaController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_pa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyPa::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->select(sprintf('%s.*', (new PolicyPa)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_pa_show';
                $editGate      = 'policy_pa_edit';
                $deleteGate    = 'policy_pa_delete';
                $crudRoutePart = 'policy-pas';

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
            $table->addColumn('insurance_product_product_name', function ($row) {
                return $row->insurance_product ? $row->insurance_product->product_name : '';
            });

            $table->editColumn('nama_tertanggung', function ($row) {
                return $row->nama_tertanggung ? $row->nama_tertanggung : '';
            });

            $table->editColumn('alamat_tertanggung', function ($row) {
                return $row->alamat_tertanggung ? $row->alamat_tertanggung : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('nama_paket', function ($row) {
                return $row->nama_paket ? $row->nama_paket : '';
            });
            $table->editColumn('upload_dokumen', function ($row) {
                if (! $row->upload_dokumen) {
                    return '';
                }
                $links = [];
                foreach ($row->upload_dokumen as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'id_policies', 'insurance_product', 'upload_dokumen', 'created_by']);

            return $table->make(true);
        }

        $policies_centrals  = PoliciesCentral::get();
        $insurance_products = InsuranceProduct::get();
        $users              = User::get();
        $crm_customers      = CrmCustomer::get();

        return view('admin.policyPas.index', compact('policies_centrals', 'insurance_products', 'users', 'crm_customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_pa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);


        return view('admin.policyPas.create', compact('assigned_to_customers', 'assigned_to_users', 'insurance_products', 'isAdmin'));
    }

    public function store(StorePolicyPaRequest $request)
    {
        DB::beginTransaction();

        try {
            $polisCentral = PoliciesCentral::create($request->only(
                                            [
                                                'assigned_to_customer_id',
                                                'policy_number',
                                                'policy_number_external',
                                                'insurance_product_id',
                                                'start_date',
                                                'end_date',
                                                'premium_amount',
                                                'discount',
                                                'discount_total',
                                                'aksessoris_tambahan',
                                                'aksesoris_harga',
                                                'biaya_lainnya',
                                                'sum_insured',
                                                'policy_status',
                                                'payment_status',
                                                'assigned_to_user_id',
                                            ])
                            );

            foreach ($request->input('external_polis_doc', []) as $file) {
                $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $policiesCentral->id]);
            }

            $policyPa = PolicyPa::create(['id_policies_id' => $polisCentral->id] + $request->only(
                [
                    'insurance_product_id',
                    'nama_tertanggung',
                    'ttl_tertanggung',
                    'alamat_tertanggung',
                    'email',
                    'phone',
                    'nama_paket',
                    'assigned_to_user_id',
                    'assigned_to_customer_id'
                ]
            ));

            foreach ($request->input('upload_dokumen', []) as $file) {
                $policyPa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $policyPa->id]);
            }

            DB::commit(); // simpan semua perubahan

            return redirect()->route('admin.policy-pas.index');

        } catch (\Throwable $e) {
            DB::rollBack(); // batalkan semua kalau error

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(PolicyPa $policyPa)
    {
        abort_if(Gate::denies('policy_pa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_policies = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policyPa->load('id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyPas.edit', compact('id_policies', 'insurance_products', 'policyPa'));
    }

    public function update(UpdatePolicyPaRequest $request, PolicyPa $policyPa)
    {
        $policyPa->update($request->all());

        if (count($policyPa->upload_dokumen) > 0) {
            foreach ($policyPa->upload_dokumen as $media) {
                if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyPa->upload_dokumen->pluck('file_name')->toArray();
        foreach ($request->input('upload_dokumen', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyPa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }
        }

        return redirect()->route('admin.policy-pas.index');
    }

    public function show(PolicyPa $policyPa)
    {
        abort_if(Gate::denies('policy_pa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyPa->load('id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyPas.show', compact('policyPa'));
    }

    public function destroy(PolicyPa $policyPa)
    {
        abort_if(Gate::denies('policy_pa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyPa->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyPaRequest $request)
    {
        $policyPas = PolicyPa::find(request('ids'));

        foreach ($policyPas as $policyPa) {
            $policyPa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policy_pa_create') && Gate::denies('policy_pa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PolicyPa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
