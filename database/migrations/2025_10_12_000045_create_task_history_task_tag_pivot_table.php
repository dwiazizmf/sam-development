<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskHistoryTaskTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('task_history_task_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('task_history_id');
            $table->foreign('task_history_id', 'task_history_id_fk_10716177')->references('id')->on('task_histories')->onDelete('cascade');
            $table->unsignedBigInteger('task_tag_id');
            $table->foreign('task_tag_id', 'task_tag_id_fk_10716177')->references('id')->on('task_tags')->onDelete('cascade');
        });
    }
}
