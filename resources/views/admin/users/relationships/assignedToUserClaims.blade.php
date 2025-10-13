<div class="m-3">
    @can('claim_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.claims.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.claim.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.claim.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToUserClaims">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.claim_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.policies') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.claim_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.claim_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.reviewed_by_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.review_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.review_notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.approved_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.payment_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.payment_reference') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.payment_method') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.assigned_to_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.claim.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($claims as $key => $claim)
                            <tr data-entry-id="{{ $claim->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $claim->id ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->claim_number ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->claim_type->claim_type_name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Claim::CLAIM_STATUS_SELECT[$claim->claim_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->reviewed_by_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->review_date ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->review_notes ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->approved_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->payment_date ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->payment_reference ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->payment_method ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->assigned_to_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $claim->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('claim_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.claims.show', $claim->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('claim_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.claims.edit', $claim->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('claim_delete')
                                        <form action="{{ route('admin.claims.destroy', $claim->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('claim_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.claims.massDestroy') }}",
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
  let table = $('.datatable-assignedToUserClaims:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection