<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPolicyVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('policy_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('id_policies_id')->nullable();
            $table->foreign('id_policies_id', 'id_policies_fk_10741445')->references('id')->on('policies_centrals');
            $table->unsignedBigInteger('jenis_pertanggungan_id')->nullable();
            $table->foreign('jenis_pertanggungan_id', 'jenis_pertanggungan_fk_10741442')->references('id')->on('jenis_pertanggungans');
            $table->unsignedBigInteger('perluasan_pertanggungan_id')->nullable();
            $table->foreign('perluasan_pertanggungan_id', 'perluasan_pertanggungan_fk_10741443')->references('id')->on('perluasan_pertanggungans');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10741444')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_customer_id')->nullable();
            $table->foreign('assigned_to_customer_id', 'assigned_to_customer_fk_10741267')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732875')->references('id')->on('users');
        });
    }
}
