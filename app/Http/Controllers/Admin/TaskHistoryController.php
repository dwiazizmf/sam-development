<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\ContactContact;
use App\Models\CrmCustomer;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TaskHistoryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('task_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TaskHistory::with(['follow_up', 'status', 'tags', 'prospect', 'customer', 'assigned_to_user', 'created_by'])->select(sprintf('%s.*', (new TaskHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'task_history_show';
                $editGate      = 'task_history_edit';
                $deleteGate    = 'task_history_delete';
                $crudRoutePart = 'task-histories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('follow_up_name', function ($row) {
                return $row->follow_up ? $row->follow_up->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->addColumn('prospect_contact_first_name', function ($row) {
                return $row->prospect ? $row->prospect->contact_first_name : '';
            });

            $table->editColumn('prospect.contact_last_name', function ($row) {
                return $row->prospect ? (is_string($row->prospect) ? $row->prospect : $row->prospect->contact_last_name) : '';
            });
            $table->addColumn('customer_first_name', function ($row) {
                return $row->customer ? $row->customer->first_name : '';
            });

            $table->editColumn('customer.last_name', function ($row) {
                return $row->customer ? (is_string($row->customer) ? $row->customer : $row->customer->last_name) : '';
            });
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'follow_up', 'status', 'tag', 'attachment', 'prospect', 'customer', 'assigned_to_user', 'created_by']);

            return $table->make(true);
        }

        $tasks            = Task::get();
        $task_statuses    = TaskStatus::get();
        $task_tags        = TaskTag::get();
        $contact_contacts = ContactContact::get();
        $crm_customers    = CrmCustomer::get();
        $users            = User::get();

        return view('admin.taskHistories.index', compact('tasks', 'task_statuses', 'task_tags', 'contact_contacts', 'crm_customers', 'users'));
    }

    public function show(TaskHistory $taskHistory)
    {
        abort_if(Gate::denies('task_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskHistory->load('follow_up', 'status', 'tags', 'prospect', 'customer', 'assigned_to_user', 'created_by');

        return view('admin.taskHistories.show', compact('taskHistory'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_history_create') && Gate::denies('task_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaskHistory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
