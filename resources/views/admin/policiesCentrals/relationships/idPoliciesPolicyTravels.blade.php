<div class="m-3">
    @can('policy_travel_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-travels.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyTravel.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyTravel.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-idPoliciesPolicyTravels">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.id_policies') }}
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
                                {{ trans('cruds.policyTravel.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.product_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.polis_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.policyholder_address') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.jumlah_wisatawan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.asal_keberangkatan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.tujuan_keberangkatan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.nama_paket') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.created_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyTravel.fields.upload') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyTravels as $key => $policyTravel)
                            <tr data-entry-id="{{ $policyTravel->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyTravel->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->discount_total ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->biaya_lainnya ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->id_policies->periode ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->insurance_product->product_code ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->polis_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->policyholder_address ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->jumlah_wisatawan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->asal_keberangkatan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->tujuan_keberangkatan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->nama_paket ?? '' }}
                                </td>
                                <td>
                                    {{ $policyTravel->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyTravel->upload as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('policy_travel_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-travels.show', $policyTravel->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_travel_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-travels.edit', $policyTravel->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_travel_delete')
                                        <form action="{{ route('admin.policy-travels.destroy', $policyTravel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_travel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-travels.massDestroy') }}",
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
  let table = $('.datatable-idPoliciesPolicyTravels:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection