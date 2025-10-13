<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PoliciesCentral extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'policies_centrals';

    protected $appends = [
        'external_polis_doc',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'policy_number',
        'policy_number_external',
        'policy_status',
    ];

    public const DATA_SOURCE_SELECT = [
        'manual'   => 'Manual Input',
        'api_sync' => 'Hook Api',
        'import'   => 'Import',
    ];

    public const PAYMENT_STATUS_SELECT = [
        'paid'     => 'paid',
        'pending'  => 'pending',
        'failed'   => 'failed',
        'refunded' => 'refunded',
    ];

    public const POLICY_STATUS_SELECT = [
        'active'    => 'active',
        'expired'   => 'expired',
        'cancelled' => 'cancelled',
        'suspended' => 'suspended',
    ];

    protected $fillable = [
        'assigned_to_customer_id',
        'policy_number',
        'policy_number_external',
        'insurance_product_id',
        'periode',
        'premium_amount',
        'discount',
        'discount_total',
        'aksessoris_tambahan',
        'aksesoris_harga',
        'biaya_lainnya',
        'sum_insured',
        'policy_status',
        'payment_status',
        'assigned_to_user_id',
        'data_source',
        'external_policy_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function policiesClaims()
    {
        return $this->hasMany(Claim::class, 'policies_id', 'id');
    }

    public function idPoliciesPolicyKesehatans()
    {
        return $this->hasMany(PolicyKesehatan::class, 'id_policies_id', 'id');
    }

    public function idPoliciesPolicyTravels()
    {
        return $this->hasMany(PolicyTravel::class, 'id_policies_id', 'id');
    }

    public function polisInvoices()
    {
        return $this->hasMany(Invoice::class, 'polis_id', 'id');
    }

    public function idPoliciesPolicyMotors()
    {
        return $this->hasMany(PolicyMotor::class, 'id_policies_id', 'id');
    }

    public function idPoliciesPolicyPas()
    {
        return $this->hasMany(PolicyPa::class, 'id_policies_id', 'id');
    }

    public function idPoliciesPolicyVehicles()
    {
        return $this->hasMany(PolicyVehicle::class, 'id_policies_id', 'id');
    }

    public function idPoliciesPolicyRumahGedungs()
    {
        return $this->hasMany(PolicyRumahGedung::class, 'id_policies_id', 'id');
    }

    public function assigned_to_customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'assigned_to_customer_id');
    }

    public function insurance_product()
    {
        return $this->belongsTo(InsuranceProduct::class, 'insurance_product_id');
    }

    public function getExternalPolisDocAttribute()
    {
        return $this->getMedia('external_polis_doc');
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function external_policy()
    {
        return $this->belongsTo(ApiSyncLog::class, 'external_policy_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
