<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCompany extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'contact_companies';

    public static $searchable = [
        'company_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'business_type_id',
        'company_name',
        'no_telp',
        'website',
        'company_email',
        'company_address',
        'city',
        'province',
        'company_website',
        'nama_bank_companies',
        'no_rekening_companies',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }
}
