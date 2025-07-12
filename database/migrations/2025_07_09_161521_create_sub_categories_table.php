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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id('sub_cat_id');
            $table->unsignedBigInteger('category_id');
            $table->string('sub_cat_name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('category_id')->references('cat_id')->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
