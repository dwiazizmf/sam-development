<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyMotorsTable extends Migration
{
    public function up()
    {
        Schema::create('policy_motors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merk_type')->nullable();
            $table->string('warna_kendaraan')->nullable();
            $table->integer('tahun_pembuatan')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('nama_tertanggung')->nullable();
            $table->longText('alamat_tertanggung')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->decimal('nilai_pertanggungan', 15, 2)->nullable();
            $table->string('sertifikat_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
