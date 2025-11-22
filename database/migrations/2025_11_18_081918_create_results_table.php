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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('study_center');
            $table->string('batch');
            $table->integer('passing_year');
            $table->float('gpa_cgpa');
            $table->json('selected_semesters'); // Store selected semesters as JSON
            $table->json('semester_results'); // Store all semester results as JSON
            $table->enum('status', ['on', 'off'])->default('on');
            $table->timestamps();
            
            $table->index('student_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
