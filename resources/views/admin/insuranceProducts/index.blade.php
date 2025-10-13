@extends('layouts.admin')
@section('content')
@can('insurance_product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.insurance-products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.insuranceProduct.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'InsuranceProduct', 'route' => 'admin.insurance-products.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.insuranceProduct.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-InsuranceProduct">
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
                        {{ trans('cruds.insuranceProduct.fields.max_claim_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceProduct.fields.commision') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceProduct.fields.policy_duration_days') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceProduct.fields.wording_product') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceProduct.fields.wording_product_doc') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('insurance_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.insurance-products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.insurance-products.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'insurance_company_company_name', name: 'insurance_company.company_name' },
{ data: 'product_type_product_type_name', name: 'product_type.product_type_name' },
{ data: 'product_code', name: 'product_code' },
{ data: 'product_name', name: 'product_name' },
{ data: 'description', name: 'description' },
{ data: 'max_claim_amount', name: 'max_claim_amount' },
{ data: 'commision', name: 'commision' },
{ data: 'policy_duration_days', name: 'policy_duration_days' },
{ data: 'wording_product', name: 'wording_product' },
{ data: 'wording_product_doc', name: 'wording_product_doc', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-InsuranceProduct').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection