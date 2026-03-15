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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Владелец (водитель)

            $table->string('brand')->default('Газель');
            $table->string('model')->nullable();
            $table->string('body_type')->default('tent'); // tent (тент), box (будка), open (борт)

            // Размеры кузова (для фильтра поиска)
            $table->double('max_weight')->default(1.5); // 1.5 тонны стандарт
            $table->double('length')->default(4.2);      // Длина (обычно 4.2м)
            $table->double('width')->default(2.0);       // Ширина
            $table->double('height')->default(2.2);      // Высота

            $table->string('current_location')->nullable()->comment('Где сейчас машина');
            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
