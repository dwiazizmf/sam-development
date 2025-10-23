<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesCentralsTable extends Migration
{
    public function up()
    {
        Schema::create('policies_centrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('policy_number')->unique();
            $table->string('policy_number_external')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('premium_amount', 15, 2);
            $table->float('discount', 15, 2)->nullable();
            $table->float('discount_total', 15, 2)->nullable();
            $table->decimal('aksessoris_tambahan', 15, 2)->nullable();
            $table->decimal('aksesoris_harga', 15, 2)->nullable();
            $table->decimal('biaya_lainnya', 15, 2)->nullable();
            $table->decimal('sum_insured', 15, 2);
            $table->string('policy_status');
            $table->string('payment_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
