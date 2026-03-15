<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем тестового пользователя (заказчика), если его нет
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Иван Грузоотправитель',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Массив реалистичных грузов для 4м Газели
        $cargos = [
            [
                'route_from' => 'Москва',
                'route_to' => 'Нижний Новгород',
                'weight' => 1.2,
                'volume' => 12,
                'price' => 15000,
                'description' => 'Офисная мебель, упакована в пленку. Погрузка задняя.',
            ],
            [
                'route_from' => 'Санкт-Петербург',
                'route_to' => 'Тверь',
                'weight' => 0.8,
                'volume' => 8,
                'price' => 12500,
                'description' => 'Запчасти для спецтехники, 2 паллета.',
            ],
            [
                'route_from' => 'Казань',
                'route_to' => 'Екатеринбург',
                'weight' => 1.5,
                'volume' => 16,
                'price' => 28000,
                'description' => 'Домашний переезд. Есть хрупкие вещи (зеркала).',
            ],
            [
                'route_from' => 'Ростов-на-Дону',
                'route_to' => 'Краснодар',
                'weight' => 1.1,
                'volume' => 10,
                'price' => 9000,
                'description' => 'Строительные материалы (смеси в мешках).',
            ],
            [
                'route_from' => 'Челябинск',
                'route_to' => 'Уфа',
                'weight' => 0.5,
                'volume' => 6,
                'price' => 7500,
                'description' => 'Коробки с одеждой. Погрузка боковая или задняя.',
            ],
        ];

        foreach ($cargos as $cargoData) {
            $user->cargos()->create($cargoData);
        }
    }
}
