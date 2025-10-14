<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionCrmCustomerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comission_crm_customer', function (Blueprint $table) {
            $table->unsignedBigInteger('comission_id');
            $table->foreign('comission_id', 'comission_id_fk_10738267')->references('id')->on('comissions')->onDelete('cascade');
            $table->unsignedBigInteger('crm_customer_id');
            $table->foreign('crm_customer_id', 'crm_customer_id_fk_10738267')->references('id')->on('crm_customers')->onDelete('cascade');
        });
    }
}
