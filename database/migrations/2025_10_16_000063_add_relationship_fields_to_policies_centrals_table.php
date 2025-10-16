<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPoliciesCentralsTable extends Migration
{
    public function up()
    {
        Schema::table('policies_centrals', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to_customer_id')->nullable();
            $table->foreign('assigned_to_customer_id', 'assigned_to_customer_fk_10741258')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('insurance_product_id')->nullable();
            $table->foreign('insurance_product_id', 'insurance_product_fk_10699752')->references('id')->on('insurance_products');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732846')->references('id')->on('users');
            $table->unsignedBigInteger('external_policy_id')->nullable();
            $table->foreign('external_policy_id', 'external_policy_fk_10699765')->references('id')->on('api_sync_logs');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10699770')->references('id')->on('users');
        });
    }
}
