@extends('layouts.admin')
@section('content')
@can('policies_central_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.policies-centrals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.policiesCentral.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PoliciesCentral', 'route' => 'admin.policies-centrals.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.policiesCentral.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PoliciesCentral">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.assigned_to_customer') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.policy_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.policy_number_external') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.insurance_product') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.premium_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.discount_total') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.aksessoris_tambahan') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.aksesoris_harga') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.biaya_lainnya') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.sum_insured') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.policy_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.payment_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.external_polis_doc') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.assigned_to_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.external_policy') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.created_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($crm_customers as $key => $item)
                                <option value="{{ $item->first_name }}">{{ $item->first_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($insurance_products as $key => $item)
                                <option value="{{ $item->product_name }}">{{ $item->product_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\PoliciesCentral::POLICY_STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\PoliciesCentral::PAYMENT_STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($api_sync_logs as $key => $item)
                                <option value="{{ $item->system_name }}">{{ $item->system_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
@can('policies_central_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policies-centrals.massDestroy') }}",
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
    ajax: "{{ route('admin.policies-centrals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'assigned_to_customer_first_name', name: 'assigned_to_customer.first_name' },
{ data: 'policy_number', name: 'policy_number' },
{ data: 'policy_number_external', name: 'policy_number_external' },
{ data: 'insurance_product_product_name', name: 'insurance_product.product_name' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'premium_amount', name: 'premium_amount' },
{ data: 'discount', name: 'discount' },
{ data: 'discount_total', name: 'discount_total' },
{ data: 'aksessoris_tambahan', name: 'aksessoris_tambahan' },
{ data: 'aksesoris_harga', name: 'aksesoris_harga' },
{ data: 'biaya_lainnya', name: 'biaya_lainnya' },
{ data: 'sum_insured', name: 'sum_insured' },
{ data: 'policy_status', name: 'policy_status' },
{ data: 'payment_status', name: 'payment_status' },
{ data: 'external_polis_doc', name: 'external_polis_doc', sortable: false, searchable: false },
{ data: 'assigned_to_user_name', name: 'assigned_to_user.name' },
{ data: 'external_policy_system_name', name: 'external_policy.system_name' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-PoliciesCentral').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection