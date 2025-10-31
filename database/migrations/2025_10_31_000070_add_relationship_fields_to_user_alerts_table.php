<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserAlertsTable extends Migration
{
    public function up()
    {
        Schema::table('user_alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10733387')->references('id')->on('users');
        });
    }
}
