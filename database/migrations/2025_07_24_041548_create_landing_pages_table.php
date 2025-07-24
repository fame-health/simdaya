<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_subtitle');
            $table->string('hero_cta_text');
            $table->string('hero_secondary_cta_text')->nullable();
            $table->string('about_title');
            $table->text('about_description');
            $table->string('programs_title');
            $table->text('programs_description');
            $table->string('testimonials_title');
            $table->text('testimonials_description');
            $table->string('cta_section_title');
            $table->text('cta_section_description');
            $table->string('cta_primary_text');
            $table->string('cta_secondary_text');
            $table->json('statistics')->nullable();
            $table->json('features')->nullable();
            $table->json('programs')->nullable();
            $table->json('testimonials')->nullable();
            $table->json('contact_info')->nullable();
            $table->json('social_media')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
