<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_10691705')->references('id')->on('contact_companies');
            $table->unsignedBigInteger('status_prospect_id')->nullable();
            $table->foreign('status_prospect_id', 'status_prospect_fk_10716243')->references('id')->on('status_prospects');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732808')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732785')->references('id')->on('users');
        });
    }
}
