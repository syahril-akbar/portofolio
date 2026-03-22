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
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('employment_type')->nullable()->after('company');
            $table->string('location_type')->nullable()->after('employment_type');
            $table->string('location')->nullable()->after('location_type');
            $table->boolean('is_current_job')->default(false)->after('end_date');
            $table->string('proof_file')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn([
                'employment_type',
                'location_type',
                'location',
                'is_current_job',
                'proof_file'
            ]);
        });
    }
};
