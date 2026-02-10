<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id('photo_id');

            $table->unsignedBigInteger('reservation_id');

            $table->string('file_name');
            $table->string('file_path');

            $table->timestamps();

            $table->foreign('reservation_id')
                ->references('reservation_id')
                ->on('reservations')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
