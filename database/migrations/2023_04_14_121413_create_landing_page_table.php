<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->id();
            $table->json('logo_image')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('about_manud_jaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_page', function (Blueprint $table) {
            Schema::dropIfExists('landing_pages');
        });
    }
};
