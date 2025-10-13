<div class="m-3">
    @can('policy_kesehatan_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-kesehatans.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyKesehatan.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyKesehatan.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-idPoliciesPolicyKesehatans">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.id_policies') }}
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
                                {{ trans('cruds.policyKesehatan.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.nama_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.ttl_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.alamat_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.nama_paket') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.upload_dokumen') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.assigned_to_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyKesehatan.fields.assigned_to_customer') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyKesehatans as $key => $policyKesehatan)
                            <tr data-entry-id="{{ $policyKesehatan->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyKesehatan->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->discount_total ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->biaya_lainnya ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->id_policies->periode ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->nama_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->ttl_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->alamat_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->email ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->nama_paket ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyKesehatan->upload_dokumen as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $policyKesehatan->assigned_to_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyKesehatan->assigned_to_customer->first_name ?? '' }}
                                </td>
                                <td>
                                    @can('policy_kesehatan_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-kesehatans.show', $policyKesehatan->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_kesehatan_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-kesehatans.edit', $policyKesehatan->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_kesehatan_delete')
                                        <form action="{{ route('admin.policy-kesehatans.destroy', $policyKesehatan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_kesehatan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-kesehatans.massDestroy') }}",
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
  let table = $('.datatable-idPoliciesPolicyKesehatans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection