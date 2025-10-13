<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTypesClaim extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'document_types_claims';

    public static $searchable = [
        'document_code',
        'document_name',
    ];

    public const IS_IMAGE_ONLY_SELECT = [
        'yes' => '1',
        'no'  => '0',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const REQUIRE_ORIGINAL_SELECT = [
        'Yes' => '1',
        'No'  => '0',
    ];

    protected $fillable = [
        'document_code',
        'document_name',
        'insurance_company_id',
        'claim_type_group_id',
        'claim_type_id',
        'description',
        'file_format_allowed',
        'max_file_size_mb',
        'is_image_only',
        'require_original',
        'validation_rules',
        'sample_document_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function insurance_company()
    {
        return $this->belongsTo(InsuranceCompany::class, 'insurance_company_id');
    }

    public function claim_type_group()
    {
        return $this->belongsTo(ClaimTypeGroup::class, 'claim_type_group_id');
    }

    public function claim_type()
    {
        return $this->belongsTo(ClaimType::class, 'claim_type_id');
    }
}
