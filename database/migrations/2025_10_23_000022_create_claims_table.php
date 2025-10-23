<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('claim_number');
            $table->string('claim_status');
            $table->datetime('review_date')->nullable();
            $table->longText('review_notes')->nullable();
            $table->decimal('approved_amount', 15, 2)->nullable();
            $table->datetime('payment_date')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
