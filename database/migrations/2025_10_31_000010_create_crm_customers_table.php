<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('crm_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->float('commission', 15, 2)->nullable();
            $table->string('nama_pic')->nullable();
            $table->string('no_telp_pic')->nullable();
            $table->string('nama_bank_pic')->nullable();
            $table->string('no_rekening_pic')->nullable();
            $table->datetime('converted_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
