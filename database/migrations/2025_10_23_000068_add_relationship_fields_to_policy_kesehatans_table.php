<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPolicyKesehatansTable extends Migration
{
    public function up()
    {
        Schema::table('policy_kesehatans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_policies_id')->nullable();
            $table->foreign('id_policies_id', 'id_policies_fk_10716139')->references('id')->on('policies_centrals');
            $table->unsignedBigInteger('insurance_product_id')->nullable();
            $table->foreign('insurance_product_id', 'insurance_product_fk_10716142')->references('id')->on('insurance_products');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732892')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_customer_id')->nullable();
            $table->foreign('assigned_to_customer_id', 'assigned_to_customer_fk_10741461')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732893')->references('id')->on('users');
        });
    }
}
