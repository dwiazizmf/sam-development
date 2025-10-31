@extends('layouts.admin')
@section('content')
@can('contact_company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contactCompany.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ContactCompany', 'route' => 'admin.contact-companies.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactCompany.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ContactCompany">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.business_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.no_telp') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.website') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.province') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_website') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.nama_bank_companies') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.no_rekening_companies') }}
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
@can('contact_company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contact-companies.massDestroy') }}",
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
    ajax: "{{ route('admin.contact-companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'business_type_name', name: 'business_type.name' },
{ data: 'company_name', name: 'company_name' },
{ data: 'no_telp', name: 'no_telp' },
{ data: 'website', name: 'website' },
{ data: 'company_email', name: 'company_email' },
{ data: 'company_address', name: 'company_address' },
{ data: 'city', name: 'city' },
{ data: 'province', name: 'province' },
{ data: 'company_website', name: 'company_website' },
{ data: 'nama_bank_companies', name: 'nama_bank_companies' },
{ data: 'no_rekening_companies', name: 'no_rekening_companies' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ContactCompany').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection