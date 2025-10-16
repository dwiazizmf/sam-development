<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('contact_companies', function (Blueprint $table) {
            $table->unsignedBigInteger('business_type_id')->nullable();
            $table->foreign('business_type_id', 'business_type_fk_10716244')->references('id')->on('business_types');
        });
    }
}
