<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCrmCustomerRequest;
use App\Http\Requests\StoreCrmCustomerRequest;
use App\Http\Requests\UpdateCrmCustomerRequest;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\CrmCustomer;
use App\Models\CrmStatus;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CrmCustomerController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crm_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CrmCustomer::with(['company', 'role', 'status', 'assigned_to_user', 'prospects_source', 'created_by'])->select(sprintf('%s.*', (new CrmCustomer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'crm_customer_show';
                $editGate      = 'crm_customer_edit';
                $deleteGate    = 'crm_customer_delete';
                $crudRoutePart = 'crm-customers';

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
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->addColumn('role_title', function ($row) {
                return $row->role ? $row->role->title : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('commission', function ($row) {
                return $row->commission ? $row->commission : '';
            });
            $table->editColumn('nama_pic', function ($row) {
                return $row->nama_pic ? $row->nama_pic : '';
            });
            $table->editColumn('no_telp_pic', function ($row) {
                return $row->no_telp_pic ? $row->no_telp_pic : '';
            });
            $table->editColumn('nama_bank_pic', function ($row) {
                return $row->nama_bank_pic ? $row->nama_bank_pic : '';
            });
            $table->editColumn('no_rekening_pic', function ($row) {
                return $row->no_rekening_pic ? $row->no_rekening_pic : '';
            });
            $table->editColumn('dokumen_legalitas', function ($row) {
                if (! $row->dokumen_legalitas) {
                    return '';
                }
                $links = [];
                foreach ($row->dokumen_legalitas as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('prospects_source_contact_first_name', function ($row) {
                return $row->prospects_source ? $row->prospects_source->contact_first_name : '';
            });

            $table->editColumn('prospects_source.contact_last_name', function ($row) {
                return $row->prospects_source ? (is_string($row->prospects_source) ? $row->prospects_source : $row->prospects_source->contact_last_name) : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'role', 'dokumen_legalitas', 'status', 'assigned_to_user', 'prospects_source', 'created_by']);

            return $table->make(true);
        }

        $contact_companies = ContactCompany::get();
        $roles             = Role::get();
        $crm_statuses      = CrmStatus::get();
        $users             = User::get();
        $contact_contacts  = ContactContact::get();

        return view('admin.crmCustomers.index', compact('contact_companies', 'roles', 'crm_statuses', 'users', 'contact_contacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('crm_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prospects_sources = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crmCustomers.create', compact('assigned_to_users', 'companies', 'prospects_sources', 'roles', 'statuses'));
    }

    public function store(StoreCrmCustomerRequest $request)
    {
        $crmCustomer = CrmCustomer::create($request->all());

        foreach ($request->input('dokumen_legalitas', []) as $file) {
            $crmCustomer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('dokumen_legalitas');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $crmCustomer->id]);
        }

        return redirect()->route('admin.crm-customers.index');
    }

    public function edit(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = CrmStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prospects_sources = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crmCustomer->load('company', 'role', 'status', 'assigned_to_user', 'prospects_source', 'created_by');

        return view('admin.crmCustomers.edit', compact('assigned_to_users', 'companies', 'crmCustomer', 'prospects_sources', 'roles', 'statuses'));
    }

    public function update(UpdateCrmCustomerRequest $request, CrmCustomer $crmCustomer)
    {
        $crmCustomer->update($request->all());

        if (count($crmCustomer->dokumen_legalitas) > 0) {
            foreach ($crmCustomer->dokumen_legalitas as $media) {
                if (! in_array($media->file_name, $request->input('dokumen_legalitas', []))) {
                    $media->delete();
                }
            }
        }
        $media = $crmCustomer->dokumen_legalitas->pluck('file_name')->toArray();
        foreach ($request->input('dokumen_legalitas', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $crmCustomer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('dokumen_legalitas');
            }
        }

        return redirect()->route('admin.crm-customers.index');
    }

    public function show(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->load('company', 'role', 'status', 'assigned_to_user', 'prospects_source', 'created_by');

        return view('admin.crmCustomers.show', compact('crmCustomer'));
    }

    public function destroy(CrmCustomer $crmCustomer)
    {
        abort_if(Gate::denies('crm_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crmCustomer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrmCustomerRequest $request)
    {
        $crmCustomers = CrmCustomer::find(request('ids'));

        foreach ($crmCustomers as $crmCustomer) {
            $crmCustomer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('crm_customer_create') && Gate::denies('crm_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CrmCustomer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
