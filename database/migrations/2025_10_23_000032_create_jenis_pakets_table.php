<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPaketsTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_pakets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
