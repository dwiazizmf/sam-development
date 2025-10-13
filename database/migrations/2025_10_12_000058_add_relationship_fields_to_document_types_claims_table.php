<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentTypesClaimsTable extends Migration
{
    public function up()
    {
        Schema::table('document_types_claims', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_company_id')->nullable();
            $table->foreign('insurance_company_id', 'insurance_company_fk_10693469')->references('id')->on('insurance_companies');
            $table->unsignedBigInteger('claim_type_group_id')->nullable();
            $table->foreign('claim_type_group_id', 'claim_type_group_fk_10693470')->references('id')->on('claim_type_groups');
            $table->unsignedBigInteger('claim_type_id')->nullable();
            $table->foreign('claim_type_id', 'claim_type_fk_10693471')->references('id')->on('claim_types');
        });
    }
}
