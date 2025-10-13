<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiSyncLog extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'api_sync_logs';

    public static $searchable = [
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'success' => 'Success',
        'error'   => 'Error',
        'timeout' => 'Timeout',
        'retry'   => 'Retry',
    ];

    protected $fillable = [
        'system_name',
        'endpoint',
        'request_data',
        'response_data',
        'response_code',
        'status',
        'error_message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
