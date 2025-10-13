<div class="m-3">
    @can('marketing_targer_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.marketing-targers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.marketingTarger.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.marketingTarger.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToUserMarketingTargers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.assigned_to_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.target_year') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.target_month') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.new_prospects_target') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.conversion_target') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.revenue_target') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.policies_target') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.followup_frequency_target') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.new_prospects_achieved') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.conversion_achieved') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.revenue_achieved') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.policies_achieved') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.followup_frequency_achieved') }}
                            </th>
                            <th>
                                {{ trans('cruds.marketingTarger.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marketingTargers as $key => $marketingTarger)
                            <tr data-entry-id="{{ $marketingTarger->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $marketingTarger->id ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->assigned_to_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->target_year ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->target_month ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->new_prospects_target ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->conversion_target ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->revenue_target ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->policies_target ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->followup_frequency_target ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->new_prospects_achieved ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->conversion_achieved ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->revenue_achieved ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->policies_achieved ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->followup_frequency_achieved ?? '' }}
                                </td>
                                <td>
                                    {{ $marketingTarger->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('marketing_targer_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.marketing-targers.show', $marketingTarger->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('marketing_targer_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.marketing-targers.edit', $marketingTarger->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('marketing_targer_delete')
                                        <form action="{{ route('admin.marketing-targers.destroy', $marketingTarger->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('marketing_targer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.marketing-targers.massDestroy') }}",
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
  let table = $('.datatable-assignedToUserMarketingTargers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection