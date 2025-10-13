<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimTypeGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('claim_type_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('claim_group_code')->nullable();
            $table->string('claim_group_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
