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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("file_alt")->nullable();
            $table->string("file_name")->nullable();
            $table->string("file_original_name")->nullable();
            $table->string("seo_title", 100);
            $table->string("seo_description");
            $table->string("seo_keywords", 500);
            $table->string('description');
            $table->longText('text');
            $table->longText('text_striped');
            $table->boolean("top")->default(false);
            $table->timestamps();

            $table->fullText(['title', 'description', 'text_striped']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function($table) {
            $table->dropFullText(['title', 'description', 'text_striped']); // removing full-text index
        });

        Schema::dropIfExists('posts');
    }
};
