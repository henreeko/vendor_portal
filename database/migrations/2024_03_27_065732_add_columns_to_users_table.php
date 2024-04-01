<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('supplier_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('office_street')->nullable();
            $table->string('office_barangay')->nullable();
            $table->string('office_zip')->nullable();
            $table->string('office_city')->nullable();
            $table->string('tin_number', 14)->nullable();
            $table->string('website_url')->nullable();
            $table->string('phone_number', 11)->nullable();
            $table->string('billing_representative_first_name')->nullable();
            $table->string('billing_representative_last_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('telephone_fax_number')->nullable();
            $table->text('products_or_services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
