@extends('layouts.admin')
@section('content')
@can('insurance_company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.insurance-companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.insuranceCompany.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'InsuranceCompany', 'route' => 'admin.insurance-companies.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.insuranceCompany.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-InsuranceCompany">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.company_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.company_short_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.province') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.postal_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.website') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.contact_person') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.contact_position') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.contact_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.contact_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.insuranceCompany.fields.logo') }}
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
@can('insurance_company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.insurance-companies.massDestroy') }}",
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
    ajax: "{{ route('admin.insurance-companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_code', name: 'company_code' },
{ data: 'company_name', name: 'company_name' },
{ data: 'company_short_name', name: 'company_short_name' },
{ data: 'phone', name: 'phone' },
{ data: 'address', name: 'address' },
{ data: 'city', name: 'city' },
{ data: 'province', name: 'province' },
{ data: 'postal_code', name: 'postal_code' },
{ data: 'email', name: 'email' },
{ data: 'website', name: 'website' },
{ data: 'contact_person', name: 'contact_person' },
{ data: 'contact_position', name: 'contact_position' },
{ data: 'contact_phone', name: 'contact_phone' },
{ data: 'contact_email', name: 'contact_email' },
{ data: 'logo', name: 'logo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-InsuranceCompany').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection