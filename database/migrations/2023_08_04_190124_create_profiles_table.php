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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->string('district');
            $table->date('date_of_birth');
            $table->string('upazila')->nullable();
            $table->string('union')->nullable();
            $table->string('village')->nullable();
            $table->string('post_office')->nullable();
            $table->string('post_code')->nullable();
            $table->string('nid')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
