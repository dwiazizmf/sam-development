@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.id') }}
                        </th>
                        <td>
                            {{ $comission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.assigned_to_user') }}
                        </th>
                        <td>
                            @foreach($comission->assigned_to_users as $key => $assigned_to_user)
                                <span class="label label-info">{{ $assigned_to_user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.from_user') }}
                        </th>
                        <td>
                            @foreach($comission->from_users as $key => $from_user)
                                <span class="label label-info">{{ $from_user->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.polis_transaction') }}
                        </th>
                        <td>
                            @foreach($comission->polis_transactions as $key => $polis_transaction)
                                <span class="label label-info">{{ $polis_transaction->policy_number }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.level') }}
                        </th>
                        <td>
                            {{ $comission->level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comission.fields.amount') }}
                        </th>
                        <td>
                            {{ $comission->amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection