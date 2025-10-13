<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('comission_id');
            $table->foreign('comission_id', 'comission_id_fk_10738266')->references('id')->on('comissions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_10738266')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
