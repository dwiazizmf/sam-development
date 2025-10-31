<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('task_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
