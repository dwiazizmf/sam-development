<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyKesehatansTable extends Migration
{
    public function up()
    {
        Schema::create('policy_kesehatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tertanggung')->nullable();
            $table->date('ttl_tertanggung')->nullable();
            $table->string('alamat_tertanggung')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nama_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
