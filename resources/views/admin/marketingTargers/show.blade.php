@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.marketingTarger.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marketing-targers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.id') }}
                        </th>
                        <td>
                            {{ $marketingTarger->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $marketingTarger->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.target_year') }}
                        </th>
                        <td>
                            {{ $marketingTarger->target_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.target_month') }}
                        </th>
                        <td>
                            {{ $marketingTarger->target_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.new_prospects_target') }}
                        </th>
                        <td>
                            {{ $marketingTarger->new_prospects_target }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.conversion_target') }}
                        </th>
                        <td>
                            {{ $marketingTarger->conversion_target }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.revenue_target') }}
                        </th>
                        <td>
                            {{ $marketingTarger->revenue_target }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.policies_target') }}
                        </th>
                        <td>
                            {{ $marketingTarger->policies_target }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.followup_frequency_target') }}
                        </th>
                        <td>
                            {{ $marketingTarger->followup_frequency_target }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.new_prospects_achieved') }}
                        </th>
                        <td>
                            {{ $marketingTarger->new_prospects_achieved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.conversion_achieved') }}
                        </th>
                        <td>
                            {{ $marketingTarger->conversion_achieved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.revenue_achieved') }}
                        </th>
                        <td>
                            {{ $marketingTarger->revenue_achieved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.policies_achieved') }}
                        </th>
                        <td>
                            {{ $marketingTarger->policies_achieved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.followup_frequency_achieved') }}
                        </th>
                        <td>
                            {{ $marketingTarger->followup_frequency_achieved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingTarger.fields.created_by') }}
                        </th>
                        <td>
                            {{ $marketingTarger->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marketing-targers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection