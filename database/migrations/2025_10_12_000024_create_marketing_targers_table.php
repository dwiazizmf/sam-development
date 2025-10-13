<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingTargersTable extends Migration
{
    public function up()
    {
        Schema::create('marketing_targers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('target_year')->nullable();
            $table->integer('target_month')->nullable();
            $table->integer('new_prospects_target')->nullable();
            $table->integer('conversion_target')->nullable();
            $table->integer('revenue_target')->nullable();
            $table->integer('policies_target')->nullable();
            $table->integer('followup_frequency_target')->nullable();
            $table->integer('new_prospects_achieved')->nullable();
            $table->integer('conversion_achieved')->nullable();
            $table->integer('revenue_achieved')->nullable();
            $table->integer('policies_achieved')->nullable();
            $table->integer('followup_frequency_achieved')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
