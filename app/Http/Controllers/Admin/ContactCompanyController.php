<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyContactCompanyRequest;
use App\Http\Requests\StoreContactCompanyRequest;
use App\Http\Requests\UpdateContactCompanyRequest;
use App\Models\BusinessType;
use App\Models\ContactCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactCompanyController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactCompany::with(['business_type'])->select(sprintf('%s.*', (new ContactCompany)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_company_show';
                $editGate      = 'contact_company_edit';
                $deleteGate    = 'contact_company_delete';
                $crudRoutePart = 'contact-companies';

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
            $table->addColumn('business_type_name', function ($row) {
                return $row->business_type ? $row->business_type->name : '';
            });

            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('no_telp', function ($row) {
                return $row->no_telp ? $row->no_telp : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('company_email', function ($row) {
                return $row->company_email ? $row->company_email : '';
            });
            $table->editColumn('company_address', function ($row) {
                return $row->company_address ? $row->company_address : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('province', function ($row) {
                return $row->province ? $row->province : '';
            });
            $table->editColumn('company_website', function ($row) {
                return $row->company_website ? $row->company_website : '';
            });
            $table->editColumn('nama_bank_companies', function ($row) {
                return $row->nama_bank_companies ? $row->nama_bank_companies : '';
            });
            $table->editColumn('no_rekening_companies', function ($row) {
                return $row->no_rekening_companies ? $row->no_rekening_companies : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'business_type']);

            return $table->make(true);
        }

        return view('admin.contactCompanies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contact_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $business_types = BusinessType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contactCompanies.create', compact('business_types'));
    }

    public function store(StoreContactCompanyRequest $request)
    {
        $contactCompany = ContactCompany::create($request->all());

        return redirect()->route('admin.contact-companies.index');
    }

    public function edit(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $business_types = BusinessType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contactCompany->load('business_type');

        return view('admin.contactCompanies.edit', compact('business_types', 'contactCompany'));
    }

    public function update(UpdateContactCompanyRequest $request, ContactCompany $contactCompany)
    {
        $contactCompany->update($request->all());

        return redirect()->route('admin.contact-companies.index');
    }

    public function show(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->load('business_type');

        return view('admin.contactCompanies.show', compact('contactCompany'));
    }

    public function destroy(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactCompanyRequest $request)
    {
        $contactCompanies = ContactCompany::find(request('ids'));

        foreach ($contactCompanies as $contactCompany) {
            $contactCompany->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
