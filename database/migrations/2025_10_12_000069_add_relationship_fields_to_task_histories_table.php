<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaskHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('task_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('follow_up_id')->nullable();
            $table->foreign('follow_up_id', 'follow_up_fk_10716182')->references('id')->on('tasks');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_10716176')->references('id')->on('task_statuses');
            $table->unsignedBigInteger('prospect_id')->nullable();
            $table->foreign('prospect_id', 'prospect_fk_10732908')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_10732909')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732910')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732911')->references('id')->on('users');
        });
    }
}
