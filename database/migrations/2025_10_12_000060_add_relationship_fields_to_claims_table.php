<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClaimsTable extends Migration
{
    public function up()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->unsignedBigInteger('policies_id')->nullable();
            $table->foreign('policies_id', 'policies_fk_10699775')->references('id')->on('policies_centrals');
            $table->unsignedBigInteger('claim_type_id')->nullable();
            $table->foreign('claim_type_id', 'claim_type_fk_10695555')->references('id')->on('claim_types');
            $table->unsignedBigInteger('reviewed_by_user_id')->nullable();
            $table->foreign('reviewed_by_user_id', 'reviewed_by_user_fk_10695558')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732901')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732902')->references('id')->on('users');
        });
    }
}
