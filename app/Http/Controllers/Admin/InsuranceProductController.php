<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInsuranceProductRequest;
use App\Http\Requests\StoreInsuranceProductRequest;
use App\Http\Requests\UpdateInsuranceProductRequest;
use App\Models\InsuranceCompany;
use App\Models\InsuranceProduct;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InsuranceProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('insurance_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InsuranceProduct::with(['insurance_company', 'product_type'])->select(sprintf('%s.*', (new InsuranceProduct)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'insurance_product_show';
                $editGate      = 'insurance_product_edit';
                $deleteGate    = 'insurance_product_delete';
                $crudRoutePart = 'insurance-products';

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
            $table->addColumn('insurance_company_company_name', function ($row) {
                return $row->insurance_company ? $row->insurance_company->company_name : '';
            });

            $table->addColumn('product_type_product_type_name', function ($row) {
                return $row->product_type ? $row->product_type->product_type_name : '';
            });

            $table->editColumn('product_code', function ($row) {
                return $row->product_code ? $row->product_code : '';
            });
            $table->editColumn('product_name', function ($row) {
                return $row->product_name ? $row->product_name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('max_claim_amount', function ($row) {
                return $row->max_claim_amount ? $row->max_claim_amount : '';
            });
            $table->editColumn('commision', function ($row) {
                return $row->commision ? $row->commision : '';
            });
            $table->editColumn('policy_duration_days', function ($row) {
                return $row->policy_duration_days ? $row->policy_duration_days : '';
            });
            $table->editColumn('wording_product', function ($row) {
                return $row->wording_product ? $row->wording_product : '';
            });
            $table->editColumn('wording_product_doc', function ($row) {
                return $row->wording_product_doc ? '<a href="' . $row->wording_product_doc->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'insurance_company', 'product_type', 'wording_product_doc']);

            return $table->make(true);
        }

        return view('admin.insuranceProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('insurance_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_types = ProductType::pluck('product_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.insuranceProducts.create', compact('insurance_companies', 'product_types'));
    }

    public function store(StoreInsuranceProductRequest $request)
    {
        $insuranceProduct = InsuranceProduct::create($request->all());

        if ($request->input('wording_product_doc', false)) {
            $insuranceProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('wording_product_doc'))))->toMediaCollection('wording_product_doc');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $insuranceProduct->id]);
        }

        return redirect()->route('admin.insurance-products.index');
    }

    public function edit(InsuranceProduct $insuranceProduct)
    {
        abort_if(Gate::denies('insurance_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance_companies = InsuranceCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_types = ProductType::pluck('product_type_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $insuranceProduct->load('insurance_company', 'product_type');

        return view('admin.insuranceProducts.edit', compact('insuranceProduct', 'insurance_companies', 'product_types'));
    }

    public function update(UpdateInsuranceProductRequest $request, InsuranceProduct $insuranceProduct)
    {
        $insuranceProduct->update($request->all());

        if ($request->input('wording_product_doc', false)) {
            if (! $insuranceProduct->wording_product_doc || $request->input('wording_product_doc') !== $insuranceProduct->wording_product_doc->file_name) {
                if ($insuranceProduct->wording_product_doc) {
                    $insuranceProduct->wording_product_doc->delete();
                }
                $insuranceProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('wording_product_doc'))))->toMediaCollection('wording_product_doc');
            }
        } elseif ($insuranceProduct->wording_product_doc) {
            $insuranceProduct->wording_product_doc->delete();
        }

        return redirect()->route('admin.insurance-products.index');
    }

    public function show(InsuranceProduct $insuranceProduct)
    {
        abort_if(Gate::denies('insurance_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceProduct->load('insurance_company', 'product_type');

        return view('admin.insuranceProducts.show', compact('insuranceProduct'));
    }

    public function destroy(InsuranceProduct $insuranceProduct)
    {
        abort_if(Gate::denies('insurance_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insuranceProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyInsuranceProductRequest $request)
    {
        $insuranceProducts = InsuranceProduct::find(request('ids'));

        foreach ($insuranceProducts as $insuranceProduct) {
            $insuranceProduct->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('insurance_product_create') && Gate::denies('insurance_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new InsuranceProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
