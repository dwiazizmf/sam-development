<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CrmCustomer extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'crm_customers';

    protected $hidden = [
        'password',
    ];

    public static $searchable = [
        'first_name',
    ];

    protected $appends = [
        'dokumen_legalitas',
    ];

    protected $dates = [
        'converted_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'email',
        'password',
        'role_id',
        'address',
        'website',
        'commission',
        'nama_pic',
        'no_telp_pic',
        'nama_bank_pic',
        'no_rekening_pic',
        'nama_bank_companies',
        'no_rekening_companies',
        'status_id',
        'assigned_to_user_id',
        'prospects_source_id',
        'converted_date',
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getDokumenLegalitasAttribute()
    {
        return $this->getMedia('dokumen_legalitas');
    }

    public function status()
    {
        return $this->belongsTo(CrmStatus::class, 'status_id');
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function prospects_source()
    {
        return $this->belongsTo(ContactContact::class, 'prospects_source_id');
    }

    public function getConvertedDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setConvertedDateAttribute($value)
    {
        $this->attributes['converted_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
