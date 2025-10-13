@extends('layouts.admin')
@section('content')
@can('api_sync_log_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.api-sync-logs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.apiSyncLog.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.apiSyncLog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ApiSyncLog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.system_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.endpoint') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.request_data') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.response_data') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.response_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.apiSyncLog.fields.error_message') }}
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
@can('api_sync_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.api-sync-logs.massDestroy') }}",
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
    ajax: "{{ route('admin.api-sync-logs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'system_name', name: 'system_name' },
{ data: 'endpoint', name: 'endpoint' },
{ data: 'request_data', name: 'request_data' },
{ data: 'response_data', name: 'response_data' },
{ data: 'response_code', name: 'response_code' },
{ data: 'status', name: 'status' },
{ data: 'error_message', name: 'error_message' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ApiSyncLog').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection