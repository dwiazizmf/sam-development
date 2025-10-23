<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_10664299')->references('id')->on('task_statuses');
            $table->unsignedBigInteger('prospect_id')->nullable();
            $table->foreign('prospect_id', 'prospect_fk_10716207')->references('id')->on('contact_contacts');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_10732905')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732906')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732907')->references('id')->on('users');
        });
    }
}
