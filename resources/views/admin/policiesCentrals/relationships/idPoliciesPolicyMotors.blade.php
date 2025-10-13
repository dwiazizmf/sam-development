<div class="m-3">
    @can('policy_motor_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.policy-motors.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.policyMotor.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policyMotor.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-idPoliciesPolicyMotors">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.id_policies') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.premium_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.sum_insured') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.merk_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.warna_kendaraan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.tahun_pembuatan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.no_polisi') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.no_rangka') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.no_mesin') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.nama_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.alamat_tertanggung') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.no_hp') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.nilai_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.jenis_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.perluasan_pertanggungan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.sertifikat_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.upload_kendaraan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policyMotor.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policyMotors as $key => $policyMotor)
                            <tr data-entry-id="{{ $policyMotor->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policyMotor->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->id_policies->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->id_policies->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->id_policies->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->merk_type ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->warna_kendaraan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->tahun_pembuatan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->no_polisi ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->no_rangka ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->no_mesin ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->nama_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->alamat_tertanggung ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->email ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->no_hp ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->nilai_pertanggungan ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->jenis_pertanggungan->jenis_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->perluasan_pertanggungan->pertanggungan_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policyMotor->sertifikat_no ?? '' }}
                                </td>
                                <td>
                                    @foreach($policyMotor->upload_kendaraan as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $policyMotor->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('policy_motor_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policy-motors.show', $policyMotor->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('policy_motor_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.policy-motors.edit', $policyMotor->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('policy_motor_delete')
                                        <form action="{{ route('admin.policy-motors.destroy', $policyMotor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('policy_motor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.policy-motors.massDestroy') }}",
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
  let table = $('.datatable-idPoliciesPolicyMotors:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection