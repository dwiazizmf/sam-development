<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClaimTypesTable extends Migration
{
    public function up()
    {
        Schema::table('claim_types', function (Blueprint $table) {
            $table->unsignedBigInteger('claim_gorup_id')->nullable();
            $table->foreign('claim_gorup_id', 'claim_gorup_fk_10693465')->references('id')->on('claim_type_groups');
        });
    }
}
