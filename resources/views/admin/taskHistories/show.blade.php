@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taskHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.task-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $taskHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.follow_up') }}
                        </th>
                        <td>
                            {{ $taskHistory->follow_up->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.name') }}
                        </th>
                        <td>
                            {{ $taskHistory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.description') }}
                        </th>
                        <td>
                            {{ $taskHistory->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.status') }}
                        </th>
                        <td>
                            {{ $taskHistory->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.tag') }}
                        </th>
                        <td>
                            @foreach($taskHistory->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.attachment') }}
                        </th>
                        <td>
                            @if($taskHistory->attachment)
                                <a href="{{ $taskHistory->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.due_date') }}
                        </th>
                        <td>
                            {{ $taskHistory->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.prospect') }}
                        </th>
                        <td>
                            {{ $taskHistory->prospect->contact_first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.customer') }}
                        </th>
                        <td>
                            {{ $taskHistory->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $taskHistory->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskHistory.fields.created_by') }}
                        </th>
                        <td>
                            {{ $taskHistory->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.task-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection