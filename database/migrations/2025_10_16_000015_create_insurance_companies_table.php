<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_code')->nullable();
            $table->string('company_name');
            $table->string('company_short_name')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_person');
            $table->string('contact_position');
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
