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
            $table->unsignedBigInteger('approved_by_procurement_officer')->nullable()->after('procurement_officer_approval_date');
            $table->unsignedBigInteger('approved_by_procurement_head')->nullable()->after('approved_by_procurement_officer');

            $table->foreign('approved_by_procurement_officer')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by_procurement_head')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['approved_by_procurement_officer']);
            $table->dropForeign(['approved_by_procurement_head']);
            $table->dropColumn(['approved_by_procurement_officer', 'approved_by_procurement_head']);
        });
    }
};
