<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📦 Разместить новый груз
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                
                <form action="{{ route('cargos.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Откуда -->
                        <div>
                            <x-input-label for="route_from" value="Откуда (Город погрузки)" />
                            <x-text-input id="route_from" name="route_from" type="text" class="mt-1 block w-full" placeholder="Напр: Москва" :value="old('route_from')" required maxlength="100"/>
                            <x-input-error :messages="$errors->get('route_from')" class="mt-2" />
                        </div>

                        <!-- Куда -->
                        <div>
                            <x-input-label for="route_to" value="Куда (Город выгрузки)" />
                            <x-text-input id="route_to" name="route_to" type="text" class="mt-1 block w-full" placeholder="Напр: Казань" :value="old('route_to')" required maxlength="100"/>
                            <x-input-error :messages="$errors->get('route_to')" class="mt-2" />
                        </div>

                        <!-- Вес (Ограничение до 2 тонн для Газели) -->
                        <div>
                            <x-input-label for="weight" value="Вес (макс. 2 тонны)" />
                            <x-text-input id="weight" name="weight" type="number" 
                                step="0.1" min="0.1" max="2" 
                                class="mt-1 block w-full" placeholder="1.5" :value="old('weight')" required />
                            <p class="mt-1 text-[10px] text-gray-500 italic">Газель не берет больше 2т по правилам сервиса</p>
                            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                        </div>

                        <!-- Объем (Ограничение до 20 м3) -->
                        <div>
                            <x-input-label for="volume" value="Объем (макс. 20 м³)" />
                            <x-text-input id="volume" name="volume" type="number" 
                                step="0.5" min="1" max="20" 
                                class="mt-1 block w-full" placeholder="16" :value="old('volume')" required />
                            <p class="mt-1 text-[10px] text-gray-500 italic">Стандарт 4м Газели — от 12 до 18 м³</p>
                            <x-input-error :messages="$errors->get('volume')" class="mt-2" />
                        </div>

                        <!-- Цена -->
                        <div>
                            <x-input-label for="price" value="Цена (₽)" />
                            <x-text-input id="price" name="price" type="number" 
                                min="500" max="500000" step="100" 
                                class="mt-1 block w-full text-green-600 font-bold" placeholder="15000" :value="old('price')" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Дата (опционально) -->
                        <div>
                            <x-input-label for="pickup_date" value="Дата погрузки" />
                            <x-text-input id="pickup_date" name="pickup_date" type="date" class="mt-1 block w-full" :value="old('pickup_date')" />
                        </div>
                    </div>

                    <!-- Описание -->
                    <div>
                        <x-input-label for="description" value="Что везем? (Доп. информация)" />
                        <textarea name="description" rows="3" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Напр: Домашний переезд, 2 паллета, нужна задняя погрузка...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('cargos.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Отмена</a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-500 py-3 px-8 shadow-lg shadow-indigo-500/30">
                            Опубликовать груз
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
