<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerluasanPertanggungansTable extends Migration
{
    public function up()
    {
        Schema::create('perluasan_pertanggungans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pertanggungan_name')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
