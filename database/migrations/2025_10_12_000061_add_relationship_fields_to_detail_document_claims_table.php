<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDetailDocumentClaimsTable extends Migration
{
    public function up()
    {
        Schema::table('detail_document_claims', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_company_id')->nullable();
            $table->foreign('insurance_company_id', 'insurance_company_fk_10695570')->references('id')->on('insurance_companies');
            $table->unsignedBigInteger('insurance_product_id')->nullable();
            $table->foreign('insurance_product_id', 'insurance_product_fk_10695571')->references('id')->on('insurance_products');
            $table->unsignedBigInteger('policies_data_id')->nullable();
            $table->foreign('policies_data_id', 'policies_data_fk_10695572')->references('id')->on('policies_centrals');
            $table->unsignedBigInteger('claim_type_id')->nullable();
            $table->foreign('claim_type_id', 'claim_type_fk_10695573')->references('id')->on('claim_types');
            $table->unsignedBigInteger('claims_id')->nullable();
            $table->foreign('claims_id', 'claims_fk_10695574')->references('id')->on('claims');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreign('assigned_to_user_id', 'assigned_to_user_fk_10732903')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10732904')->references('id')->on('users');
        });
    }
}
