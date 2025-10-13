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

class PolicyVehicle extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'policy_vehicles';

    protected $appends = [
        'upload_kendaraan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_policies_id',
        'merk_type',
        'warna_kendaraan',
        'tahun_pembuatan',
        'no_polisi',
        'no_rangka',
        'no_mesin',
        'nama_tertanggung',
        'alamat_tertanggung',
        'email',
        'no_hp',
        'nilai_pertanggungan',
        'jenis_pertanggungan_id',
        'perluasan_pertanggungan_id',
        'sertifikat_no',
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

    public function jenis_pertanggungan()
    {
        return $this->belongsTo(JenisPertanggungan::class, 'jenis_pertanggungan_id');
    }

    public function perluasan_pertanggungan()
    {
        return $this->belongsTo(PerluasanPertanggungan::class, 'perluasan_pertanggungan_id');
    }

    public function getUploadKendaraanAttribute()
    {
        return $this->getMedia('upload_kendaraan');
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
}
