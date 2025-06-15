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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_govt_id')->unique(); 
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->index();
            $table->foreignId('department_id')->constrained();
            $table->date('hire_date');
            $table->enum('status', ['active', 'inactive']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
