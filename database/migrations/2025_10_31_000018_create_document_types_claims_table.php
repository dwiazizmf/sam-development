<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypesClaimsTable extends Migration
{
    public function up()
    {
        Schema::create('document_types_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_code')->nullable();
            $table->string('document_name');
            $table->longText('description')->nullable();
            $table->string('file_format_allowed');
            $table->float('max_file_size_mb', 15, 2)->nullable();
            $table->string('is_image_only');
            $table->string('require_original');
            $table->longText('validation_rules')->nullable();
            $table->string('sample_document_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
