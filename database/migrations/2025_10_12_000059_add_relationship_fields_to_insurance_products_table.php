<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInsuranceProductsTable extends Migration
{
    public function up()
    {
        Schema::table('insurance_products', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_company_id')->nullable();
            $table->foreign('insurance_company_id', 'insurance_company_fk_10695542')->references('id')->on('insurance_companies');
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->foreign('product_type_id', 'product_type_fk_10695551')->references('id')->on('product_types');
        });
    }
}
