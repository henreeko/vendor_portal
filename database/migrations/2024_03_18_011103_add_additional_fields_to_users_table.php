<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('supplier_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tin_number', 14)->nullable();
            $table->string('website_url')->nullable();
            $table->string('phone_number', 11)->nullable();
            $table->string('billing_representative_first_name')->nullable();
            $table->string('billing_representative_last_name')->nullable();
            $table->string('business_type')->nullable();
            $table->text('products_or_services')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'supplier_type', 'company_name', 'tin_number', 'website_url', 'phone_number',
                'billing_representative_first_name', 'billing_representative_last_name', 'business_type', 'products_or_services',
            ]);
        });
    }
}
