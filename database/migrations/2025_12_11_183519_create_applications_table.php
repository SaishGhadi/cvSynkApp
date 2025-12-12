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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            
            $table->uuid('job_uuid');
            $table->uuid('candidate_uuid');

            $table->enum('status', ['applied', 'selected', 'rejected'])
                  ->default('applied');

            $table->timestamps();
        });

        // Add foreign key constraints (uuid is NOT the PK)
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('job_uuid')
                  ->references('uuid')
                  ->on('jobs')
                  ->onDelete('cascade');

            $table->foreign('candidate_uuid')
                  ->references('uuid')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
