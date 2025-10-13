<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPertanggungansTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_pertanggungans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_name');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
