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
    Schema::create('showcase_photos', function (Blueprint $table) {
        $table->id();
        $table->string('path'); // This will store the link to the image file
        $table->string('caption')->nullable(); // Optional: so admin can add a title
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcase_photos');
    }
};
