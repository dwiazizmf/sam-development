<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_type_code')->nullable();
            $table->string('product_type_name');
            $table->longText('product_type_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
