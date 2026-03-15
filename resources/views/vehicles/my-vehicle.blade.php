<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🚛 Настройки моей Газели
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100 dark:border-gray-700">

                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-800 font-medium text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- 1. Статус активности (на всю ширину) -->
                    <div class="p-4 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" class="sr-only peer"
                                {{ ($vehicle->is_available ?? true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600 font-bold">
                            </div>
                            <span id="status-text" class="ml-3 text-sm font-bold text-gray-900 dark:text-gray-300 uppercase tracking-wider">
                                {{ ($vehicle->is_available ?? true) ? '🟢 Свободен (Виден в поиске)' : '🔴 Занят (Скрыт из поиска)' }}
                            </span>
                        </label>
                        <p class="mt-2 text-[10px] text-gray-500 italic">Выключите этот пункт, если вы уже на заказе и не хотите звонков.</p>
                    </div>

                    <!-- 2. Сетка основных характеристик (2 колонки на ПК, 1 на мобильном) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Марка/Модель -->
                        <div>
                            <x-input-label for="brand" value="Марка и модель машины" />
                            <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full"
                                value="{{ $vehicle->brand ?? 'Газель Бизнес' }}" required />
                        </div>

                        <!-- Тип кузова -->
                        <div>
                            <x-input-label for="body_type" value="Тип кузова" />
                            <select name="body_type"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="tent" {{ ($vehicle->body_type ?? '') == 'tent' ? 'selected' : '' }}>Тент (растентовка)</option>
                                <option value="box" {{ ($vehicle->body_type ?? '') == 'box' ? 'selected' : '' }}>Будка (изотерм)</option>
                                <option value="refrigerated" {{ ($vehicle->body_type ?? '') == 'refrigerated' ? 'selected' : '' }}>Рефрижератор</option>
                                <option value="open" {{ ($vehicle->body_type ?? '') == 'open' ? 'selected' : '' }}>Открытый борт</option>
                            </select>
                        </div>

                        <!-- Характеристики -->
                        <div>
                            <x-input-label for="length" value="Длина кузова (метры)" />
                            <x-text-input id="length" name="length" type="number" step="0.1" min="1" max="6"
                                class="mt-1 block w-full" value="{{ $vehicle->length ?? '4.2' }}" />
                        </div>

                        <div>
                            <x-input-label for="max_weight" value="Грузоподъемность (тонн)" />
                            <x-text-input id="max_weight" name="max_weight" type="number" step="0.1" min="0.1" max="5"
                                class="mt-1 block w-full" value="{{ $vehicle->max_weight ?? '1.5' }}" />
                        </div>
                    </div>

                    <!-- 3. Локация (на всю ширину) -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-input-label for="current_location" value="Ваше текущее местоположение (Город)" />
                        <x-text-input id="current_location" name="current_location" type="text"
                            class="mt-1 block w-full" placeholder="Напр: Нижний Новгород"
                            value="{{ $vehicle->current_location ?? '' }}" />
                        <p class="mt-2 text-xs text-gray-500 italic font-medium">Это поможет заказчикам найти вас поблизости.</p>
                    </div>

                    <!-- Кнопка сохранения -->
                    <div class="flex items-center justify-end pt-6">
                        <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 text-base">
                            Сохранить настройки гаража
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Скрипт живого обновления текста статуса -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.querySelector('input[name="is_available"]');
            const statusText = document.getElementById('status-text');

            checkbox.addEventListener('change', function() {
                statusText.innerText = this.checked 
                    ? '🟢 Свободен (Виден в поиске)' 
                    : '🔴 Занят (Скрыт из поиска)';
            });
        });
    </script>
</x-app-layout>
