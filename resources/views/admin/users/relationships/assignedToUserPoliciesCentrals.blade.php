<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.policiesCentral.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToUserPoliciesCentrals">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.assigned_to_customer') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.policy_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.policy_number_external') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.premium_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.discount') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.discount_total') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.aksessoris_tambahan') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.aksesoris_harga') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.biaya_lainnya') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.sum_insured') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.policy_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.payment_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.external_polis_doc') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.assigned_to_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.external_policy') }}
                            </th>
                            <th>
                                {{ trans('cruds.policiesCentral.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policiesCentrals as $key => $policiesCentral)
                            <tr data-entry-id="{{ $policiesCentral->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $policiesCentral->id ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->assigned_to_customer->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->policy_number_external ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->premium_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->discount ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->discount_total ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->aksessoris_tambahan ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->aksesoris_harga ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->biaya_lainnya ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->sum_insured ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\PoliciesCentral::POLICY_STATUS_SELECT[$policiesCentral->policy_status] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\PoliciesCentral::PAYMENT_STATUS_SELECT[$policiesCentral->payment_status] ?? '' }}
                                </td>
                                <td>
                                    @foreach($policiesCentral->external_polis_doc as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $policiesCentral->assigned_to_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->external_policy->system_name ?? '' }}
                                </td>
                                <td>
                                    {{ $policiesCentral->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('policies_central_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.policies-centrals.show', $policiesCentral->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-assignedToUserPoliciesCentrals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection