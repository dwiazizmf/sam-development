<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCrmCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_10733388')->references('id')->on('roles');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_10691504')->references('id')->on('crm_statuses');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732837')->references('id')->on('users');
            $table->unsignedBigInteger('prospects_source_id')->nullable();
            $table->foreign('prospects_source_id', 'prospects_source_fk_10732809')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10716168')->references('id')->on('users');
        });
    }
}
