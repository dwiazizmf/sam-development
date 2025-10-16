<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiSyncLogsTable extends Migration
{
    public function up()
    {
        Schema::create('api_sync_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('system_name')->nullable();
            $table->string('endpoint')->nullable();
            $table->longText('request_data')->nullable();
            $table->longText('response_data')->nullable();
            $table->string('response_code')->nullable();
            $table->string('status')->nullable();
            $table->longText('error_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
