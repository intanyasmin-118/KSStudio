<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->integer('duration_minutes'); // 15, 25 etc
            $table->decimal('price', 8, 2); // 30.00 etc
            $table->integer('pax_min')->default(1);
            $table->integer('pax_max')->default(1);
            $table->text('description')->nullable(); // for read more
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

