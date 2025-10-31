<div class="m-3">
    @can('crm_customer_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.crm-customers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.crmCustomer.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.crmCustomer.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToUserCrmCustomers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.company') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.first_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.role') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.nama_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.no_telp_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.nama_bank_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.no_rekening_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.dokumen_legalitas') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.assigned_to_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.prospects_source') }}
                            </th>
                            <th>
                                {{ trans('cruds.contactContact.fields.contact_last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.converted_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crmCustomers as $key => $crmCustomer)
                            <tr data-entry-id="{{ $crmCustomer->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $crmCustomer->id ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->company->company_name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->email ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->role->title ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->address ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->commission ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->nama_pic ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->no_telp_pic ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->nama_bank_pic ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->no_rekening_pic ?? '' }}
                                </td>
                                <td>
                                    @foreach($crmCustomer->dokumen_legalitas as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $crmCustomer->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->assigned_to_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->prospects_source->contact_first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->prospects_source->contact_last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->converted_date ?? '' }}
                                </td>
                                <td>
                                    {{ $crmCustomer->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('crm_customer_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.crm-customers.show', $crmCustomer->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('crm_customer_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.crm-customers.edit', $crmCustomer->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('crm_customer_delete')
                                        <form action="{{ route('admin.crm-customers.destroy', $crmCustomer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('crm_customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-customers.massDestroy') }}",
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
  let table = $('.datatable-assignedToUserCrmCustomers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection