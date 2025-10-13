@extends('layouts.admin')
@section('content')
@can('policy_pa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.policy-pas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.policyPa.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PolicyPa', 'route' => 'admin.policy-pas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.policyPa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PolicyPa">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.id_policies') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.premium_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.discount_total') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.sum_insured') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.biaya_lainnya') }}
                    </th>
                    <th>
                        {{ trans('cruds.policiesCentral.fields.periode') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.insurance_product') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.nama_tertanggung') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.ttl_tertanggung') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.alamat_tertanggung') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.nama_paket') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.upload_dokumen') }}
                    </th>
                    <th>
                        {{ trans('cruds.policyPa.fields.created_by') }}
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
                            @foreach($policies_centrals as $key => $item)
                                <option value="{{ $item->policy_number }}">{{ $item->policy_number }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('policy_pa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-pas.massDestroy') }}",
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
    ajax: "{{ route('admin.policy-pas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'id_policies_policy_number', name: 'id_policies.policy_number' },
{ data: 'id_policies.premium_amount', name: 'id_policies.premium_amount' },
{ data: 'id_policies.discount_total', name: 'id_policies.discount_total' },
{ data: 'id_policies.sum_insured', name: 'id_policies.sum_insured' },
{ data: 'id_policies.biaya_lainnya', name: 'id_policies.biaya_lainnya' },
{ data: 'id_policies.periode', name: 'id_policies.periode' },
{ data: 'insurance_product_product_name', name: 'insurance_product.product_name' },
{ data: 'nama_tertanggung', name: 'nama_tertanggung' },
{ data: 'ttl_tertanggung', name: 'ttl_tertanggung' },
{ data: 'alamat_tertanggung', name: 'alamat_tertanggung' },
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'nama_paket', name: 'nama_paket' },
{ data: 'upload_dokumen', name: 'upload_dokumen', sortable: false, searchable: false },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-PolicyPa').DataTable(dtOverrideGlobals);
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