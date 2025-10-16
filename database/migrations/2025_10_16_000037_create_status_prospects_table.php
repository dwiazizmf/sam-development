<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusProspectsTable extends Migration
{
    public function up()
    {
        Schema::create('status_prospects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
