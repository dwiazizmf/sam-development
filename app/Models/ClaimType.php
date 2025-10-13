<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimType extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'claim_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'claim_type_code',
        'claim_type_name',
    ];

    protected $fillable = [
        'claim_gorup_id',
        'claim_type_code',
        'claim_type_name',
        'description',
        'max_claim_amount',
        'processing_time_days',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function claim_gorup()
    {
        return $this->belongsTo(ClaimTypeGroup::class, 'claim_gorup_id');
    }
}
