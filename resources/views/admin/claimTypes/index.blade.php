@extends('layouts.admin')
@section('content')
@can('claim_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.claim-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.claimType.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ClaimType', 'route' => 'admin.claim-types.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.claimType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ClaimType">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.claim_gorup') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimTypeGroup.fields.claim_group_name') }}
                    </th>
                    <th>
                        {{ trans('Coverage Claim') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.claim_type_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.max_claim_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.claimType.fields.processing_time_days') }}
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
@can('claim_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.claim-types.massDestroy') }}",
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
    ajax: "{{ route('admin.claim-types.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'claim_gorup_claim_group_code', name: 'claim_gorup.claim_group_code' },
{ data: 'claim_gorup.claim_group_name', name: 'claim_gorup.claim_group_name' },
{ data: 'claim_type_code', name: 'claim_type_code' },
{ data: 'claim_type_name', name: 'claim_type_name' },
{ data: 'description', name: 'description' },
{ data: 'max_claim_amount', name: 'max_claim_amount' },
{ data: 'processing_time_days', name: 'processing_time_days' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ClaimType').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection