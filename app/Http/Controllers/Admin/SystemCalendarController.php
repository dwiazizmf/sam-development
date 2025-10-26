<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\PoliciesCentral',
            'date_field' => 'policy_end_date',
            'field'      => 'policy_number',
            'prefix'     => 'end policy number :',
            'suffix'     => '',
            'route'      => 'admin.policies-centrals.edit',
        ],
        [
            'model'      => '\App\Models\Task',
            'date_field' => 'due_date',
            'field'      => 'name',
            'prefix'     => 'task end',
            'suffix'     => '',
            'route'      => 'admin.tasks.edit',
        ],
        [
            'model'      => '\App\Models\Claim',
            'date_field' => 'payment_date',
            'field'      => 'claim_number',
            'prefix'     => 'payment date claim',
            'suffix'     => '',
            'route'      => 'admin.claims.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()['end_date'];
                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
