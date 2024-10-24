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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('parent_id')->nullable()->constrained('parent_categories')->onDelete('cascade');
//            $table->unsignedBigInteger('parent_id');
//            $table->foreign('parent_id')->references('id')->on('parent_categories');
            $table->string('name');
            $table->enum('type',['income','expense']);
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
