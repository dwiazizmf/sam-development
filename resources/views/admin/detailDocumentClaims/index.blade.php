@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DetailDocumentClaim">
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
                        {{ trans('cruds.detailDocumentClaim.fields.file_document_claim') }}
                    </th>
                    <th>
                        {{ trans('cruds.detailDocumentClaim.fields.assigned_to_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.detailDocumentClaim.fields.created_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('detail_document_claim_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.detail-document-claims.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.detail-document-claims.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'insurance_company_company_code', name: 'insurance_company.company_code' },
{ data: 'insurance_company.company_name', name: 'insurance_company.company_name' },
{ data: 'insurance_product_product_code', name: 'insurance_product.product_code' },
{ data: 'insurance_product.product_name', name: 'insurance_product.product_name' },
{ data: 'policies_data_policy_number', name: 'policies_data.policy_number' },
{ data: 'claim_type_claim_type_name', name: 'claim_type.claim_type_name' },
{ data: 'claims_claim_number', name: 'claims.claim_number' },
{ data: 'file_document_claim', name: 'file_document_claim', sortable: false, searchable: false },
{ data: 'assigned_to_user_name', name: 'assigned_to_user.name' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-DetailDocumentClaim').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection