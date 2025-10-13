<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.comission.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToUserComissions">
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
                    <tbody>
                        @foreach($comissions as $key => $comission)
                            <tr data-entry-id="{{ $comission->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $comission->id ?? '' }}
                                </td>
                                <td>
                                    @foreach($comission->assigned_to_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($comission->from_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->first_name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($comission->polis_transactions as $key => $item)
                                        <span class="badge badge-info">{{ $item->policy_number }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $comission->level ?? '' }}
                                </td>
                                <td>
                                    {{ $comission->amount ?? '' }}
                                </td>
                                <td>
                                    @can('comission_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.comissions.show', $comission->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-assignedToUserComissions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection