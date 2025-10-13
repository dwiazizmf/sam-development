<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'claims';

    public static $searchable = [
        'claim_number',
        'claim_status',
    ];

    protected $dates = [
        'review_date',
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CLAIM_STATUS_SELECT = [
        'draft'        => 'draft',
        'submitted'    => 'submitted',
        'under_review' => 'under_review',
        'approved'     => 'approved',
        'rejected'     => 'rejected',
        'paid'         => 'paid',
        'cancelled'    => 'cancelled',
    ];

    protected $fillable = [
        'claim_number',
        'policies_id',
        'claim_type_id',
        'claim_status',
        'reviewed_by_user_id',
        'review_date',
        'review_notes',
        'approved_amount',
        'payment_date',
        'payment_reference',
        'payment_method',
        'assigned_to_user_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function claimsDetailDocumentClaims()
    {
        return $this->hasMany(DetailDocumentClaim::class, 'claims_id', 'id');
    }

    public function policies()
    {
        return $this->belongsTo(PoliciesCentral::class, 'policies_id');
    }

    public function claim_type()
    {
        return $this->belongsTo(ClaimType::class, 'claim_type_id');
    }

    public function reviewed_by_user()
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }

    public function getReviewDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setReviewDateAttribute($value)
    {
        $this->attributes['review_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPaymentDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
