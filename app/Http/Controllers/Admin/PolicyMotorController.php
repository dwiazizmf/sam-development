<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPolicyMotorRequest;
use App\Http\Requests\StorePolicyMotorRequest;
use App\Http\Requests\UpdatePolicyMotorRequest;
use App\Models\CrmCustomer;
use App\Models\InsuranceProduct;
use App\Models\JenisPertanggungan;
use App\Models\PerluasanPertanggungan;
use App\Models\PoliciesCentral;
use App\Models\PolicyMotor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StorePolicyUnifiedRequest;
use App\Http\Requests\UpdatePolicyUnifiedRequest;

class PolicyMotorController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('policy_motor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PolicyMotor::with(['id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by'])->select(sprintf('%s.*', (new PolicyMotor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'policy_motor_show';
                $editGate      = 'policy_motor_edit';
                $deleteGate    = 'policy_motor_delete';
                $crudRoutePart = 'policy-motors';

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
            $table->editColumn('id_policies.sum_insured', function ($row) {
                return $row->id_policies ? (is_string($row->id_policies) ? $row->id_policies : $row->id_policies->sum_insured) : '';
            });
            $table->editColumn('merk_type', function ($row) {
                return $row->merk_type ? $row->merk_type : '';
            });
            $table->editColumn('warna_kendaraan', function ($row) {
                return $row->warna_kendaraan ? $row->warna_kendaraan : '';
            });
            $table->editColumn('tahun_pembuatan', function ($row) {
                return $row->tahun_pembuatan ? $row->tahun_pembuatan : '';
            });
            $table->editColumn('no_polisi', function ($row) {
                return $row->no_polisi ? $row->no_polisi : '';
            });
            $table->editColumn('no_rangka', function ($row) {
                return $row->no_rangka ? $row->no_rangka : '';
            });
            $table->editColumn('no_mesin', function ($row) {
                return $row->no_mesin ? $row->no_mesin : '';
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
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : '';
            });
            $table->editColumn('nilai_pertanggungan', function ($row) {
                return $row->nilai_pertanggungan ? $row->nilai_pertanggungan : '';
            });
            $table->addColumn('jenis_pertanggungan_jenis_name', function ($row) {
                return $row->jenis_pertanggungan ? $row->jenis_pertanggungan->jenis_name : '';
            });

            $table->addColumn('perluasan_pertanggungan_pertanggungan_name', function ($row) {
                return $row->perluasan_pertanggungan ? $row->perluasan_pertanggungan->pertanggungan_name : '';
            });

            $table->editColumn('sertifikat_no', function ($row) {
                return $row->sertifikat_no ? $row->sertifikat_no : '';
            });
            $table->editColumn('upload_kendaraan', function ($row) {
                if (! $row->upload_kendaraan) {
                    return '';
                }
                $links = [];
                foreach ($row->upload_kendaraan as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'upload_kendaraan', 'created_by']);

            return $table->make(true);
        }

        $policies_centrals        = PoliciesCentral::get();
        $jenis_pertanggungans     = JenisPertanggungan::get();
        $perluasan_pertanggungans = PerluasanPertanggungan::get();
        $users                    = User::get();
        $crm_customers            = CrmCustomer::get();

        return view('admin.policyMotors.index', compact('policies_centrals', 'jenis_pertanggungans', 'perluasan_pertanggungans', 'users', 'crm_customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_motor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);

        $jenis_pertanggungans = JenisPertanggungan::pluck('jenis_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $perluasan_pertanggungans = PerluasanPertanggungan::pluck('pertanggungan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.policyMotors.create', compact('assigned_to_customers', 'assigned_to_users', 'insurance_products', 'isAdmin', 'jenis_pertanggungans', 'perluasan_pertanggungans'));
    }

    public function store(StorePolicyUnifiedRequest $request, PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            $subPolis = $policyMotor->create($childData);

            foreach ($request->input('upload_kendaraan', []) as $file) {
                $subPolis->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $subPolis->id]);
            }

            DB::commit(); // simpan semua perubahan

            return redirect()->route('admin.policy-motors.index');

        } catch (\Throwable $e) {
            DB::rollBack(); // batalkan semua kalau error

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_to_customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insurance_products = InsuranceProduct::pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::where('id', '!=', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $isAdmin = auth()->user()->roles->contains(1);

        $jenis_pertanggungans = JenisPertanggungan::pluck('jenis_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $perluasan_pertanggungans = PerluasanPertanggungan::pluck('pertanggungan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        //$policyMotor->load('id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyMotors.edit', [
            'policiesCentral' => $policyMotor->id_policies,
            'assigned_to_customers' => $assigned_to_customers,
            'insurance_products' => $insurance_products,
            'assigned_to_users' => $assigned_to_users,
            'jenis_pertanggungans' => $jenis_pertanggungans, 
            'perluasan_pertanggungans' => $perluasan_pertanggungans, 
            'policyMotor' => $policyMotor,
            'isAdmin' => $isAdmin]);
    }

    public function update(UpdatePolicyUnifiedRequest $request, PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::beginTransaction();

            // Insert ke tabel central
            $policiesCentral = $policyMotor->id_policies;
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
            $policyMotor->update($childData);

            if (count($policyMotor->upload_kendaraan) > 0) {
                foreach ($policyMotor->upload_kendaraan as $media) {
                    if (! in_array($media->file_name, $request->input('upload_kendaraan', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $policyMotor->upload_kendaraan->pluck('file_name')->toArray();
            foreach ($request->input('upload_kendaraan', []) as $file) {
                if (count($media) === 0 || ! in_array($file, $media)) {
                    $policyMotor->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('upload_kendaraan');
                }
            }

            DB::commit();
            return redirect()->route('admin.policy-motors.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan polis', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show(PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyMotor->load('id_policies', 'jenis_pertanggungan', 'perluasan_pertanggungan', 'assigned_to_user', 'assigned_to_customer', 'created_by');

        return view('admin.policyMotors.show', compact('policyMotor'));
    }

    public function destroy(PolicyMotor $policyMotor)
    {
        abort_if(Gate::denies('policy_motor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policyMotor->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyMotorRequest $request)
    {
        $policyMotors = PolicyMotor::find(request('ids'));

        foreach ($policyMotors as $policyMotor) {
            $policyMotor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('policy_motor_create') && Gate::denies('policy_motor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PolicyMotor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
