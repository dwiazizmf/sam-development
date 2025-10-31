<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('website')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('company_website')->nullable();
            $table->string('nama_bank_companies')->nullable();
            $table->string('no_rekening_companies')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
