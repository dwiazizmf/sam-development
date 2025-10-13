<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContact extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'contact_contacts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PRIORITY_SELECT = [
        'medium' => 'medium',
        'high'   => 'high',
        'urgent' => 'urgent',
    ];

    public static $searchable = [
        'contact_first_name',
        'contact_last_name',
        'contact_phone_1',
        'contact_phone_2',
    ];

    public const LEAD_SOURCE_SELECT = [
        'referral'      => 'referral',
        'cold_call'     => 'cold call',
        'website'       => 'website',
        'event'         => 'event',
        'social_media'  => 'social media',
        'advertisement' => 'advertisement',
        'other'         => 'other',
    ];

    protected $fillable = [
        'company_id',
        'contact_first_name',
        'contact_last_name',
        'contact_phone_1',
        'contact_phone_2',
        'contact_email',
        'contact_address',
        'lead_source',
        'lead_source_detail',
        'potential_revenue',
        'estimated_policies_per_month',
        'priority',
        'status_prospect_id',
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

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function status_prospect()
    {
        return $this->belongsTo(StatusProspect::class, 'status_prospect_id');
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
