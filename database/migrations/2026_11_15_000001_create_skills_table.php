<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('General');  // e.g. Frontend, Backend, Database
            $table->unsignedTinyInteger('level')->default(80); // 1–100 proficiency
            $table->string('icon')->nullable();               // SVG/emoji/icon class
            $table->string('color')->nullable();              // accent color hex
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
