<div class="m-3">
    @can('detail_document_claim_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.detail-document-claims.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.detailDocumentClaim.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.detailDocumentClaim.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-insuranceProductDetailDocumentClaims">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.insurance_company') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceCompany.fields.company_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.insurance_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.insuranceProduct.fields.product_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.policies_data') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.claim_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.claims') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.created_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.detailDocumentClaim.fields.file_document_claim') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailDocumentClaims as $key => $detailDocumentClaim)
                            <tr data-entry-id="{{ $detailDocumentClaim->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $detailDocumentClaim->id ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->insurance_company->company_code ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->insurance_company->company_name ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->insurance_product->product_code ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->insurance_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->policies_data->policy_number ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->claim_type->claim_type_name ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->claims->claim_number ?? '' }}
                                </td>
                                <td>
                                    {{ $detailDocumentClaim->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @if($detailDocumentClaim->file_document_claim)
                                        <a href="{{ $detailDocumentClaim->file_document_claim->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('detail_document_claim_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.detail-document-claims.show', $detailDocumentClaim->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('detail_document_claim_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.detail-document-claims.edit', $detailDocumentClaim->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('detail_document_claim_delete')
                                        <form action="{{ route('admin.detail-document-claims.destroy', $detailDocumentClaim->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('detail_document_claim_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.detail-document-claims.massDestroy') }}",
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
  let table = $('.datatable-insuranceProductDetailDocumentClaims:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection