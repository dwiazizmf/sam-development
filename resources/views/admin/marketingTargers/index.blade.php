@extends('layouts.admin')
@section('content')
@can('marketing_targer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.marketing-targers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.marketingTarger.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'MarketingTarger', 'route' => 'admin.marketing-targers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.marketingTarger.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MarketingTarger">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.assigned_to_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.target_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.target_month') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.new_prospects_target') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.conversion_target') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.revenue_target') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.policies_target') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.followup_frequency_target') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.new_prospects_achieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.conversion_achieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.revenue_achieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.policies_achieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.followup_frequency_achieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.marketingTarger.fields.created_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
@can('marketing_targer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.marketing-targers.massDestroy') }}",
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
    ajax: "{{ route('admin.marketing-targers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'assigned_to_user_name', name: 'assigned_to_user.name' },
{ data: 'target_year', name: 'target_year' },
{ data: 'target_month', name: 'target_month' },
{ data: 'new_prospects_target', name: 'new_prospects_target' },
{ data: 'conversion_target', name: 'conversion_target' },
{ data: 'revenue_target', name: 'revenue_target' },
{ data: 'policies_target', name: 'policies_target' },
{ data: 'followup_frequency_target', name: 'followup_frequency_target' },
{ data: 'new_prospects_achieved', name: 'new_prospects_achieved' },
{ data: 'conversion_achieved', name: 'conversion_achieved' },
{ data: 'revenue_achieved', name: 'revenue_achieved' },
{ data: 'policies_achieved', name: 'policies_achieved' },
{ data: 'followup_frequency_achieved', name: 'followup_frequency_achieved' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-MarketingTarger').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection