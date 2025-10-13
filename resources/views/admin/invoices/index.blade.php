@extends('layouts.admin')
@section('content')
@can('invoice_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Invoice', 'route' => 'admin.invoices.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.polis') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.invoice_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.total_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.subtotal_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.tax_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.discount_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.paid_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.reference_no') }}
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
@can('invoice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoices.massDestroy') }}",
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
    ajax: "{{ route('admin.invoices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'polis_policy_number', name: 'polis.policy_number' },
{ data: 'invoice_number', name: 'invoice_number' },
{ data: 'total_amount', name: 'total_amount' },
{ data: 'subtotal_amount', name: 'subtotal_amount' },
{ data: 'tax_amount', name: 'tax_amount' },
{ data: 'discount_amount', name: 'discount_amount' },
{ data: 'status', name: 'status' },
{ data: 'due_date', name: 'due_date' },
{ data: 'paid_at', name: 'paid_at' },
{ data: 'payment_method', name: 'payment_method' },
{ data: 'notes', name: 'notes' },
{ data: 'reference_no', name: 'reference_no' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Invoice').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection