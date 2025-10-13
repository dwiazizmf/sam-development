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

class PolicyTravel extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'policy_travels';

    protected $appends = [
        'upload',
    ];

    public static $searchable = [
        'polis_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_policies_id',
        'insurance_product_id',
        'polis_name',
        'policyholder_address',
        'jumlah_wisatawan',
        'asal_keberangkatan',
        'tujuan_keberangkatan',
        'nama_paket',
        'assigned_to_user_id',
        'assigned_to_customer_id',
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

    public function id_policies()
    {
        return $this->belongsTo(PoliciesCentral::class, 'id_policies_id');
    }

    public function insurance_product()
    {
        return $this->belongsTo(InsuranceProduct::class, 'insurance_product_id');
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function assigned_to_customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'assigned_to_customer_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getUploadAttribute()
    {
        return $this->getMedia('upload');
    }
}
