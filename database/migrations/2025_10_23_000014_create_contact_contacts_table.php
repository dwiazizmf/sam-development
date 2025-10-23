<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_phone_1')->nullable()->unique();
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('lead_source_detail')->nullable();
            $table->decimal('potential_revenue', 15, 2)->nullable();
            $table->string('estimated_policies_per_month')->nullable();
            $table->string('priority')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
