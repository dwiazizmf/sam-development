<div class="m-3">
    @can('task_history_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.task-histories.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.taskHistory.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taskHistory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-followUpTaskHistories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.tag') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.attachment') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.due_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.assigned_to') }}
                            </th>
                            <th>
                                {{ trans('cruds.taskHistory.fields.follow_up') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taskHistories as $key => $taskHistory)
                            <tr data-entry-id="{{ $taskHistory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $taskHistory->id ?? '' }}
                                </td>
                                <td>
                                    {{ $taskHistory->name ?? '' }}
                                </td>
                                <td>
                                    {{ $taskHistory->description ?? '' }}
                                </td>
                                <td>
                                    {{ $taskHistory->status->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($taskHistory->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($taskHistory->attachment)
                                        <a href="{{ $taskHistory->attachment->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $taskHistory->due_date ?? '' }}
                                </td>
                                <td>
                                    {{ $taskHistory->assigned_to->name ?? '' }}
                                </td>
                                <td>
                                    {{ $taskHistory->follow_up->name ?? '' }}
                                </td>
                                <td>
                                    @can('task_history_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.task-histories.show', $taskHistory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('task_history_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.task-histories.edit', $taskHistory->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('task_history_delete')
                                        <form action="{{ route('admin.task-histories.destroy', $taskHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('task_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.task-histories.massDestroy') }}",
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
  let table = $('.datatable-followUpTaskHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection