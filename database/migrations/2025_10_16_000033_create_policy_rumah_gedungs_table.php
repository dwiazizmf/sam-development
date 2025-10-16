<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyRumahGedungsTable extends Migration
{
    public function up()
    {
        Schema::create('policy_rumah_gedungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lokasi_pertanggungan')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('nama_tertanggung')->nullable();
            $table->date('ttl_tertanggung')->nullable();
            $table->string('alamat_tertanggung')->nullable();
            $table->string('email')->nullable();
            $table->string('no_phone')->nullable();
            $table->string('nama_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
