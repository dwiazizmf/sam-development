<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionPoliciesCentralPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comission_policies_central', function (Blueprint $table) {
            $table->unsignedBigInteger('comission_id');
            $table->foreign('comission_id', 'comission_id_fk_10738268')->references('id')->on('comissions')->onDelete('cascade');
            $table->unsignedBigInteger('policies_central_id');
            $table->foreign('policies_central_id', 'policies_central_id_fk_10738268')->references('id')->on('policies_centrals')->onDelete('cascade');
        });
    }
}
