<div class="m-3">
    @can('policy_pa_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-pas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyPa.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyPa.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-idPoliciesPolicyPas">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.id_policies') }}
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
                                {{ trans('cruds.policiesCentral.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.nama_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.ttl_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.alamat_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.nama_paket') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.upload_dokumen') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyPa.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyPas as $key => $policyPa)
                            <tr data-entry-id="{{ $policyPa->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyPa->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->discount_total ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->biaya_lainnya ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->id_policies->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->nama_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->ttl_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->alamat_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->email ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $policyPa->nama_paket ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyPa->upload_dokumen as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $policyPa->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('policy_pa_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-pas.show', $policyPa->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_pa_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-pas.edit', $policyPa->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_pa_delete')
                                        <form action="{{ route('admin.policy-pas.destroy', $policyPa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_pa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-pas.massDestroy') }}",
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
  let table = $('.datatable-idPoliciesPolicyPas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection