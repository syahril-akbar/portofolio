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
        Schema::table('education', function (Blueprint $table) {
            $table->string('grade')->nullable();
            $table->string('location_type')->nullable();
            $table->string('location')->nullable();
            $table->text('activities')->nullable();
            $table->string('certificate_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn([
                'grade',
                'location_type',
                'location',
                'activities',
                'certificate_file',
            ]);
        });
    }
};
