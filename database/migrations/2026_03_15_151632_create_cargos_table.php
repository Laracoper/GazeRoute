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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Кто создал (заказчик)

            // Маршрут
            $table->string('route_from')->comment('Город погрузки');
            $table->string('route_to')->comment('Город выгрузки');
            $table->date('pickup_date')->nullable()->comment('Дата забора груза');

            // Характеристики (важно для Газели)
            $table->decimal('weight', 8, 2)->comment('Вес в тоннах (напр. 1.50)');
            $table->decimal('volume', 8, 2)->comment('Объем в м3');
            $table->double('length')->default(4.0)->comment('Длина груза в метрах');

            // Деньги
            $table->integer('price')->unsigned()->nullable()->comment('Цена в рублях');
            $table->string('currency')->default('RUB');

            // Доп инфо
            $table->text('description')->nullable()->comment('Что везем? (напр. мебель, доски)');
            $table->string('status')->default('active'); // active, processing, completed

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
