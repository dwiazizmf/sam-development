<div class="m-3">
    @can('policy_rumah_gedung_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-rumah-gedungs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyRumahGedung.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyRumahGedung.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-idPoliciesPolicyRumahGedungs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.id_policies') }}
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
                                {{ trans('cruds.policyRumahGedung.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.lokasi_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.jenis_rumah_gedung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.keterangan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.jenis_paket') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.nama_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.ttl_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.alamat_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.no_phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.nama_paket') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.upload_dokumen') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyRumahGedung.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyRumahGedungs as $key => $policyRumahGedung)
                            <tr data-entry-id="{{ $policyRumahGedung->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyRumahGedung->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->discount_total ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->biaya_lainnya ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->id_policies->periode ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->lokasi_pertanggungan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->jenis_rumah_gedung->name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->keterangan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->jenis_paket->name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->nama_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->ttl_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->alamat_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->email ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->no_phone ?? '' }}
                                </td>
                                <td>
                                    {{ $policyRumahGedung->nama_paket ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyRumahGedung->upload_dokumen as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $policyRumahGedung->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('policy_rumah_gedung_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-rumah-gedungs.show', $policyRumahGedung->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_rumah_gedung_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-rumah-gedungs.edit', $policyRumahGedung->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_rumah_gedung_delete')
                                        <form action="{{ route('admin.policy-rumah-gedungs.destroy', $policyRumahGedung->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_rumah_gedung_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-rumah-gedungs.massDestroy') }}",
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
  let table = $('.datatable-idPoliciesPolicyRumahGedungs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection