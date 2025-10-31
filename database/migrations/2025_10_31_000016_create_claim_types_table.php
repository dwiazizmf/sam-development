<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimTypesTable extends Migration
{
    public function up()
    {
        Schema::create('claim_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('claim_type_code')->nullable();
            $table->string('claim_type_name');
            $table->longText('description')->nullable();
            $table->decimal('max_claim_amount', 15, 2)->nullable();
            $table->integer('processing_time_days')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
