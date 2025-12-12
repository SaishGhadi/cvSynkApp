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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            
            $table->string('title');
            $table->text('description');

            // FK to users.uuid
            $table->uuid('company_uuid');
            
            // Salary fields (decimal)
            $table->decimal('salary_from', 10, 2)->nullable();
            $table->decimal('salary_to', 10, 2)->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Index for company_uuid
            $table->index('company_uuid');
        });

        // Add FK separately (users.uuid is not primary)
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('company_uuid')
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
        Schema::dropIfExists('jobs');
    }
};
