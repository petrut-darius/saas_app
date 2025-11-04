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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("location")->nullable();
            $table->text("description")->nullable();
            $table->string("url")->nullable();
            $table->date("starts_at")->nullable();
            $table->date("ends_at")->nullable();
            $table->date("cfp_starts_at")->nullable();
            $table->date("cfp_ends_at")->nullable();
            $table->string("callingallpapers_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
