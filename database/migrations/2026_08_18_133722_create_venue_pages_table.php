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
        Schema::create('venue_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('availability_badge');
            $table->string('description_title');
            $table->text('description');
            $table->text('testimonial');
            $table->string('wa_number');
            $table->json('facilities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_pages');
    }
};
