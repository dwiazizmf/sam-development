<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionsTable extends Migration
{
    public function up()
    {
        Schema::create('comissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
