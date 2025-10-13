<div class="m-3">
    @can('insurance_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.insurance-products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.insuranceProduct.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.insuranceProduct.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-productTypeInsuranceProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.insurance_company') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.product_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.product_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.product_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.wording_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.max_claim_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.policy_duration_days') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.min_age') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.max_age') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.geographical_coverage') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.is_active') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.wording_product_doc') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insuranceProducts as $key => $insuranceProduct)
                            <tr data-entry-id="{{ $insuranceProduct->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $insuranceProduct->id ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->insurance_company->company_name ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->product_type->product_type_name ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->product_code ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->description ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->wording_product ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->max_claim_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->policy_duration_days ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->min_age ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->max_age ?? '' }}
                                </td>
                                <td>
                                    {{ $insuranceProduct->geographical_coverage ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\InsuranceProduct::IS_ACTIVE_SELECT[$insuranceProduct->is_active] ?? '' }}
                                </td>
                                <td>
                                    @if($insuranceProduct->wording_product_doc)
                                        <a href="{{ $insuranceProduct->wording_product_doc->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('insurance_product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.insurance-products.show', $insuranceProduct->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('insurance_product_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.insurance-products.edit', $insuranceProduct->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('insurance_product_delete')
                                        <form action="{{ route('admin.insurance-products.destroy', $insuranceProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('insurance_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.insurance-products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-productTypeInsuranceProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection