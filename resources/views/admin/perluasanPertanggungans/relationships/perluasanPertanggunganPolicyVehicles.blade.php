<div class="m-3">
    @can('policy_vehicle_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-vehicles.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyVehicle.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyVehicle.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-perluasanPertanggunganPolicyVehicles">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.id_policies') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.policy_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.policy_number_external_detail') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.agent_travel') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.policy_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.jenis_kendaraan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.warna_kendaraan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.tahun_pembuatan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.no_polisi') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.no_rangka') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.no_mesin') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.nama_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.no_hp') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.alamat_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.jenis_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.perluasan_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.nilai_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.policy_end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.policy_start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.last_sync_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.external_policy') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.updated_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.nilai_premi') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.discount') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.net_premi') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyVehicle.fields.upload_dokumen') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyVehicles as $key => $policyVehicle)
                            <tr data-entry-id="{{ $policyVehicle->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyVehicle->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->policy_number_external_detail ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->agent_travel->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->agent_travel->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\PolicyVehicle::POLICY_STATUS_SELECT[$policyVehicle->policy_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->jenis_kendaraan->jenisname ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->warna_kendaraan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->tahun_pembuatan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->no_polisi ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->no_rangka ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->no_mesin ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->nama_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->email ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->no_hp ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->alamat_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->jenis_pertanggungan->jenis_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->perluasan_pertanggungan->pertanggungan_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->nilai_pertanggungan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->policy_end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->policy_start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->last_sync_at ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->external_policy->system_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->updated_by->name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->nilai_premi ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->discount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyVehicle->net_premi ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyVehicle->upload_dokumen as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('policy_vehicle_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-vehicles.show', $policyVehicle->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_vehicle_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-vehicles.edit', $policyVehicle->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_vehicle_delete')
                                        <form action="{{ route('admin.policy-vehicles.destroy', $policyVehicle->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_vehicle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-vehicles.massDestroy') }}",
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
  let table = $('.datatable-perluasanPertanggunganPolicyVehicles:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection