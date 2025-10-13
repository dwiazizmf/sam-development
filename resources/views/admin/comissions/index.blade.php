@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.comission.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Comission">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.assigned_to_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.from_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.polis_transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.level') }}
                    </th>
                    <th>
                        {{ trans('cruds.comission.fields.amount') }}
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
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.comissions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'assigned_to_user', name: 'assigned_to_users.name' },
{ data: 'from_user', name: 'from_users.first_name' },
{ data: 'polis_transaction', name: 'polis_transactions.policy_number' },
{ data: 'level', name: 'level' },
{ data: 'amount', name: 'amount' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Comission').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection