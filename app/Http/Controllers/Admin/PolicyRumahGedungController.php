<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPolicyRumahGedungRequest;
use App\Http\Requests\StorePolicyRumahGedungRequest;
use App\Http\Requests\UpdatePolicyRumahGedungRequest;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\JenisPaket;
use App\Models\JenisRumahGedung;
use App\Models\PoliciesCentral;
use App\Models\PolicyRumahGedung;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StorePolicyUnifiedRequest;
use App\Http\Requests\UpdatePolicyUnifiedRequest;

class PolicyRumahGedungController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_rumah_gedung_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyRumahGedung::with(['id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->select(sprintf('%s.*', (new PolicyRumahGedung)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_rumah_gedung_show';
                $editGate      = 'policy_rumah_gedung_edit';
                $deleteGate    = 'policy_rumah_gedung_delete';
                $crudRoutePart = 'policy-rumah-gedungs';

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

            $table->editColumn('lokasi_pertanggungan', function ($row) {
                return $row->lokasi_pertanggungan ? $row->lokasi_pertanggungan : '';
            });
            $table->addColumn('jenis_rumah_gedung_name', function ($row) {
                return $row->jenis_rumah_gedung ? $row->jenis_rumah_gedung->name : '';
            });

            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });
            $table->addColumn('jenis_paket_name', function ($row) {
                return $row->jenis_paket ? $row->jenis_paket->name : '';
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
            $table->editColumn('no_phone', function ($row) {
                return $row->no_phone ? $row->no_phone : '';
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

            $table->rawColumns(['actions', 'placeholder', 'id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'upload_dokumen', 'created_by']);

            return $table->make(true);
        }

        $policies_centrals   = PoliciesCentral::get();
        $insurance_products  = InsuranceProduct::get();
        $jenis_rumah_gedungs = JenisRumahGedung::get();
        $jenis_pakets        = JenisPaket::get();
        $users               = User::get();
        $crm_customers       = CrmCustomer::get();

        return view('admin.policyRumahGedungs.index', compact('policies_centrals', 'insurance_products', 'jenis_rumah_gedungs', 'jenis_pakets', 'users', 'crm_customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_rumah_gedung_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);

        $jenis_rumah_gedungs = JenisRumahGedung::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_pakets = JenisPaket::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.policyRumahGedungs.create', compact('assigned_to_customers', 'assigned_to_users', 'insurance_products', 'isAdmin', 'jenis_pakets', 'jenis_rumah_gedungs'));
    }

    public function store(StorePolicyUnifiedRequest $request, PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::beginTransaction();
            // Insert ke tabel central
            $policiesCentral = PoliciesCentral::create($request->centralData());

            foreach ($request->input('external_polis_doc', []) as $file) {
                $policiesCentral->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_polis_doc');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $policiesCentral->id]);
            }

            $childData = $request->childData();
            $childData['id_policies_id'] = $policiesCentral->id;
            $subPolis = $policyRumahGedung->create($childData);

            foreach ($request->input('upload_dokumen', []) as $file) {
                $subPolis->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $subPolis->id]);
            }

            DB::commit(); // simpan semua perubahan

            return redirect()->route('admin.policy-rumah-gedungs.index');

        } catch (\Throwable $e) {
            DB::rollBack(); // batalkan semua kalau error

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);

        $jenis_rumah_gedungs = JenisRumahGedung::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_pakets = JenisPaket::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        //$policyRumahGedung->load('id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyRumahGedungs.edit', [
            'policiesCentral' => $policyRumahGedung->id_policies,
            'assigned_to_customers' => $assigned_to_customers,
            'insurance_products' => $insurance_products,
            'assigned_to_users' => $assigned_to_users,
            'policyRumahGedung' => $policyRumahGedung,
            'isAdmin' => $isAdmin,
            'jenis_rumah_gedungs' => $jenis_rumah_gedungs,
            'jenis_pakets' => $jenis_pakets]);
    }

    public function update(UpdatePolicyUnifiedRequest $request, PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::beginTransaction();

            // Insert ke tabel central
            $policiesCentral = $policyRumahGedung->id_policies;
            $policiesCentral->update($request->centralData());
                       
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

            // Insert ke child sesuai type
            $childData = $request->childData();
            $childData['id_policies_id'] = $policiesCentral->id;
            $policyRumahGedung->update($childData);

            $policyRumahGedung->update($request->all());
            if (count($policyRumahGedung->upload_dokumen) > 0) {
                foreach ($policyRumahGedung->upload_dokumen as $media) {
                    if (! in_array($media->file_name, $request->input('upload_dokumen', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $policyRumahGedung->upload_dokumen->pluck('file_name')->toArray();
            foreach ($request->input('upload_dokumen', []) as $file) {
                if (count($media) === 0 || ! in_array($file, $media)) {
                    $policyRumahGedung->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_dokumen');
                }
            }

            DB::commit();
            return redirect()->route('admin.policy-rumah-gedungs.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan polis', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show(PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyRumahGedung->load('id_policies', 'insurance_product', 'jenis_rumah_gedung', 'jenis_paket', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyRumahGedungs.show', compact('policyRumahGedung'));
    }

    public function destroy(PolicyRumahGedung $policyRumahGedung)
    {
        abort_if(Gate::denies('policy_rumah_gedung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyRumahGedung->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyRumahGedungRequest $request)
    {
        $policyRumahGedungs = PolicyRumahGedung::find(request('ids'));

        foreach ($policyRumahGedungs as $policyRumahGedung) {
            $policyRumahGedung->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policy_rumah_gedung_create') && Gate::denies('policy_rumah_gedung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PolicyRumahGedung();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
