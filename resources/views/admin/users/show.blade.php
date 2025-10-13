@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.two_factor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.parent') }}
                        </th>
                        <td>
                            {{ $user->parent->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.commission_rate') }}
                        </th>
                        <td>
                            {{ $user->commission_rate }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_crm_customers" role="tab" data-toggle="tab">
                {{ trans('cruds.crmCustomer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_policies_centrals" role="tab" data-toggle="tab">
                {{ trans('cruds.policiesCentral.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_claims" role="tab" data-toggle="tab">
                {{ trans('cruds.claim.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_marketing_targers" role="tab" data-toggle="tab">
                {{ trans('cruds.marketingTarger.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigned_to_user_comissions" role="tab" data-toggle="tab">
                {{ trans('cruds.comission.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_crm_customers">
            @includeIf('admin.users.relationships.assignedToUserCrmCustomers', ['crmCustomers' => $user->assignedToUserCrmCustomers])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_policies_centrals">
            @includeIf('admin.users.relationships.assignedToUserPoliciesCentrals', ['policiesCentrals' => $user->assignedToUserPoliciesCentrals])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_claims">
            @includeIf('admin.users.relationships.assignedToUserClaims', ['claims' => $user->assignedToUserClaims])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_tasks">
            @includeIf('admin.users.relationships.assignedToUserTasks', ['tasks' => $user->assignedToUserTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_marketing_targers">
            @includeIf('admin.users.relationships.assignedToUserMarketingTargers', ['marketingTargers' => $user->assignedToUserMarketingTargers])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_user_alerts">
            @includeIf('admin.users.relationships.assignedToUserUserAlerts', ['userAlerts' => $user->assignedToUserUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigned_to_user_comissions">
            @includeIf('admin.users.relationships.assignedToUserComissions', ['comissions' => $user->assignedToUserComissions])
        </div>
    </div>
</div>

@endsection