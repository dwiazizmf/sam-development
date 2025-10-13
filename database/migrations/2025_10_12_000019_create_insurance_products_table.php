<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceProductsTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code')->nullable();
            $table->string('product_name');
            $table->longText('description')->nullable();
            $table->integer('max_claim_amount')->nullable();
            $table->float('commision', 15, 2)->nullable();
            $table->integer('policy_duration_days')->nullable();
            $table->longText('wording_product')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
