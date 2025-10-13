<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPolicyRumahGedungsTable extends Migration
{
    public function up()
    {
        Schema::table('policy_rumah_gedungs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_policies_id')->nullable();
            $table->foreign('id_policies_id', 'id_policies_fk_10741457')->references('id')->on('policies_centrals');
            $table->unsignedBigInteger('insurance_product_id')->nullable();
            $table->foreign('insurance_product_id', 'insurance_product_fk_10716112')->references('id')->on('insurance_products');
            $table->unsignedBigInteger('jenis_rumah_gedung_id')->nullable();
            $table->foreign('jenis_rumah_gedung_id', 'jenis_rumah_gedung_fk_10716116')->references('id')->on('jenis_rumah_gedungs');
            $table->unsignedBigInteger('jenis_paket_id')->nullable();
            $table->foreign('jenis_paket_id', 'jenis_paket_fk_10716118')->references('id')->on('jenis_pakets');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732890')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_customer_id')->nullable();
            $table->foreign('assigned_to_customer_id', 'assigned_to_customer_fk_10741460')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732891')->references('id')->on('users');
        });
    }
}
