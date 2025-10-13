@extends('layouts.admin')
@section('content')
@can('document_types_claim_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.document-types-claims.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.documentTypesClaim.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DocumentTypesClaim', 'route' => 'admin.document-types-claims.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.documentTypesClaim.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DocumentTypesClaim">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.document_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.document_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.insurance_company') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.claim_type_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.claim_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.file_format_allowed') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.max_file_size_mb') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.is_image_only') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.require_original') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.validation_rules') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentTypesClaim.fields.sample_document_path') }}
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
@can('document_types_claim_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.document-types-claims.massDestroy') }}",
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
    ajax: "{{ route('admin.document-types-claims.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'document_code', name: 'document_code' },
{ data: 'document_name', name: 'document_name' },
{ data: 'insurance_company_company_name', name: 'insurance_company.company_name' },
{ data: 'claim_type_group_claim_group_name', name: 'claim_type_group.claim_group_name' },
{ data: 'claim_type_claim_type_name', name: 'claim_type.claim_type_name' },
{ data: 'description', name: 'description' },
{ data: 'file_format_allowed', name: 'file_format_allowed' },
{ data: 'max_file_size_mb', name: 'max_file_size_mb' },
{ data: 'is_image_only', name: 'is_image_only' },
{ data: 'require_original', name: 'require_original' },
{ data: 'validation_rules', name: 'validation_rules' },
{ data: 'sample_document_path', name: 'sample_document_path' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-DocumentTypesClaim').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection