<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->enum('status', ['new', 'in_progress', 'done'])->default('new');
            $table->text('note')->nullable();
            $table->foreignId('assigned_to')->constrained('users');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
