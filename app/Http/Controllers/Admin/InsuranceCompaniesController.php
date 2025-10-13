<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInsuranceCompanyRequest;
use App\Http\Requests\StoreInsuranceCompanyRequest;
use App\Http\Requests\UpdateInsuranceCompanyRequest;
use App\Models\InsuranceCompany;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InsuranceCompaniesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('insurance_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InsuranceCompany::query()->select(sprintf('%s.*', (new InsuranceCompany)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'insurance_company_show';
                $editGate      = 'insurance_company_edit';
                $deleteGate    = 'insurance_company_delete';
                $crudRoutePart = 'insurance-companies';

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
            $table->editColumn('company_code', function ($row) {
                return $row->company_code ? $row->company_code : '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('company_short_name', function ($row) {
                return $row->company_short_name ? $row->company_short_name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('province', function ($row) {
                return $row->province ? $row->province : '';
            });
            $table->editColumn('postal_code', function ($row) {
                return $row->postal_code ? $row->postal_code : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('contact_person', function ($row) {
                return $row->contact_person ? $row->contact_person : '';
            });
            $table->editColumn('contact_position', function ($row) {
                return $row->contact_position ? $row->contact_position : '';
            });
            $table->editColumn('contact_phone', function ($row) {
                return $row->contact_phone ? $row->contact_phone : '';
            });
            $table->editColumn('contact_email', function ($row) {
                return $row->contact_email ? $row->contact_email : '';
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo']);

            return $table->make(true);
        }

        return view('admin.insuranceCompanies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('insurance_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.insuranceCompanies.create');
    }

    public function store(StoreInsuranceCompanyRequest $request)
    {
        $insuranceCompany = InsuranceCompany::create($request->all());

        if ($request->input('logo', false)) {
            $insuranceCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $insuranceCompany->id]);
        }

        return redirect()->route('admin.insurance-companies.index');
    }

    public function edit(InsuranceCompany $insuranceCompany)
    {
        abort_if(Gate::denies('insurance_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.insuranceCompanies.edit', compact('insuranceCompany'));
    }

    public function update(UpdateInsuranceCompanyRequest $request, InsuranceCompany $insuranceCompany)
    {
        $insuranceCompany->update($request->all());

        if ($request->input('logo', false)) {
            if (! $insuranceCompany->logo || $request->input('logo') !== $insuranceCompany->logo->file_name) {
                if ($insuranceCompany->logo) {
                    $insuranceCompany->logo->delete();
                }
                $insuranceCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($insuranceCompany->logo) {
            $insuranceCompany->logo->delete();
        }

        return redirect()->route('admin.insurance-companies.index');
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
        abort_if(Gate::denies('insurance_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.insuranceCompanies.show', compact('insuranceCompany'));
    }

    public function destroy(InsuranceCompany $insuranceCompany)
    {
        abort_if(Gate::denies('insurance_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyInsuranceCompanyRequest $request)
    {
        $insuranceCompanies = InsuranceCompany::find(request('ids'));

        foreach ($insuranceCompanies as $insuranceCompany) {
            $insuranceCompany->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('insurance_company_create') && Gate::denies('insurance_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new InsuranceCompany();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
