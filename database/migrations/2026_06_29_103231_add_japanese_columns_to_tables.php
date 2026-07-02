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
        Schema::table('settings', function (Blueprint $table) {
            $table->text('value_ja')->nullable()->after('value_en');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title_en');
            $table->text('excerpt_ja')->nullable()->after('excerpt_en');
            $table->longText('content_ja')->nullable()->after('content_en');
        });

        Schema::table('field_stories', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title_en');
            $table->text('excerpt_ja')->nullable()->after('excerpt_en');
            $table->longText('content_ja')->nullable()->after('content_en');
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title_en');
            $table->text('subtitle_ja')->nullable()->after('subtitle_en');
            $table->string('cta_text_ja')->nullable()->after('cta_text_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('value_ja');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'excerpt_ja', 'content_ja']);
        });

        Schema::table('field_stories', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'excerpt_ja', 'content_ja']);
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'subtitle_ja', 'cta_text_ja']);
        });
    }
};
