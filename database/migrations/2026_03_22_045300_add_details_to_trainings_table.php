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
        Schema::table('trainings', function (Blueprint $table) {
            $table->renameColumn('date', 'start_date');
            $table->date('end_date')->nullable();
            $table->string('vocational_field')->nullable();
            $table->string('sub_vocational_field')->nullable();
            $table->string('location_type')->nullable();
            $table->string('location')->nullable();
            $table->string('certificate_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->renameColumn('start_date', 'date');
            $table->dropColumn([
                'end_date',
                'vocational_field',
                'sub_vocational_field',
                'location_type',
                'location',
                'certificate_file'
            ]);
        });
    }
};
