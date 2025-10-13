<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyTravelsTable extends Migration
{
    public function up()
    {
        Schema::create('policy_travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('polis_name');
            $table->longText('policyholder_address');
            $table->integer('jumlah_wisatawan');
            $table->string('asal_keberangkatan')->nullable();
            $table->string('tujuan_keberangkatan')->nullable();
            $table->string('nama_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
