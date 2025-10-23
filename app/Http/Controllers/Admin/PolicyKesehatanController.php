<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPolicyKesehatanRequest;
use App\Http\Requests\StorePolicyKesehatanRequest;
use App\Http\Requests\UpdatePolicyKesehatanRequest;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\PoliciesCentral;
use App\Models\PolicyKesehatan;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PolicyKesehatanController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_kesehatan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyKesehatan::with(['id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->select(sprintf('%s.*', (new PolicyKesehatan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_kesehatan_show';
                $editGate      = 'policy_kesehatan_edit';
                $deleteGate    = 'policy_kesehatan_delete';
                $crudRoutePart = 'policy-kesehatans';

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
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('assigned_to_customer_first_name', function ($row) {
                return $row->assigned_to_customer ? $row->assigned_to_customer->first_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'id_policies', 'insurance_product', 'upload_dokumen', 'assigned_to_user', 'assigned_to_customer']);

            return $table->make(true);
        }

        $policies_centrals  = PoliciesCentral::get();
        $insurance_products = InsuranceProduct::get();
        $users              = User::get();
        $crm_customers      = CrmCustomer::get();

        return view('admin.policyKesehatans.index', compact('policies_centrals', 'insurance_products', 'users', 'crm_customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_kesehatan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_policies = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.policyKesehatans.create', compact('assigned_to_customers', 'assigned_to_users', 'id_policies', 'insurance_products'));
    }

    public function store(StorePolicyKesehatanRequest $request)
    {
        $policyKesehatan = PolicyKesehatan::create($request->all());

        foreach ($request->input('upload_dokumen', []) as $file) {
            $policyKesehatan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $policyKesehatan->id]);
        }

        return redirect()->route('admin.policy-kesehatans.index');
    }

    public function edit(PolicyKesehatan $policyKesehatan)
    {
        abort_if(Gate::denies('policy_kesehatan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_policies = PoliciesCentral::pluck('policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policyKesehatan->load('id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyKesehatans.edit', compact('assigned_to_customers', 'assigned_to_users', 'id_policies', 'insurance_products', 'policyKesehatan'));
    }

    public function update(UpdatePolicyKesehatanRequest $request, PolicyKesehatan $policyKesehatan)
    {
        $policyKesehatan->update($request->all());

        if (count($policyKesehatan->upload_dokumen) > 0) {
            foreach ($policyKesehatan->upload_dokumen as $media) {
                if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        $media = $policyKesehatan->upload_dokumen->pluck('file_name')->toArray();
        foreach ($request->input('upload_dokumen', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $policyKesehatan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }
        }

        return redirect()->route('admin.policy-kesehatans.index');
    }

    public function show(PolicyKesehatan $policyKesehatan)
    {
        abort_if(Gate::denies('policy_kesehatan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyKesehatan->load('id_policies', 'insurance_product', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyKesehatans.show', compact('policyKesehatan'));
    }

    public function destroy(PolicyKesehatan $policyKesehatan)
    {
        abort_if(Gate::denies('policy_kesehatan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyKesehatan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyKesehatanRequest $request)
    {
        $policyKesehatans = PolicyKesehatan::find(request('ids'));

        foreach ($policyKesehatans as $policyKesehatan) {
            $policyKesehatan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policy_kesehatan_create') && Gate::denies('policy_kesehatan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PolicyKesehatan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
