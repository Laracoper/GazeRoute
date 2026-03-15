<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            🚛 Свободные Газели <span class="text-sm font-normal text-gray-500">(4 метра)</span>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <form action="{{ route('vehicles.all') }}" method="GET"
            class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex flex-col md:flex-row gap-4 items-end">

                <!-- Поиск по городу -->
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Поиск по городу</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">📍</span>
                        <input type="text" name="city" value="{{ request('city') }}"
                            placeholder="Введите город (напр: Москва)"
                            class="w-full pl-10 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="flex-1 md:flex-none bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-8 rounded-xl transition shadow-lg shadow-indigo-500/20">
                        Найти машину
                    </button>
                    @if (request('city'))
                        <a href="{{ route('vehicles.all') }}"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-xl hover:bg-gray-300 transition text-center flex items-center">
                            ❌
                        </a>
                    @endif
                </div>

            </div>
        </form>
    </div>


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($vehicles as $vehicle)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 hover:shadow-xl transition-all duration-300 relative overflow-hidden group">

                        <!-- Тип кузова -->
                        <div
                            class="absolute top-0 right-0 mt-4 mr-4 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            {{ $vehicle->body_type }}
                        </div>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-indigo-500 rounded-xl text-white text-xl shadow-lg shadow-indigo-500/20">
                                🚚
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-900 dark:text-white">{{ $vehicle->brand }}</h3>
                                <p class="text-sm text-emerald-500 font-bold flex items-center gap-1">
                                    <span class="animate-pulse">📍</span>
                                    {{ $vehicle->current_location ?? 'Локация не указана' }}
                                </p>

                            </div>
                        </div>

                        <!-- Характеристики машины -->
                        <div class="grid grid-cols-2 gap-4 py-4 border-t border-gray-50 dark:border-gray-700/50 mb-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter">
                                    Грузоподъемность</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 text-sm">
                                    {{ $vehicle->max_weight }} т</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter">Длина кузова
                                </p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ $vehicle->length }}
                                    м</p>
                            </div>
                        </div>

                        <!-- Футер (Контакты) -->
                        <div
                            class="flex items-center justify-between pt-4 border-t border-gray-50 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-bold text-indigo-500">
                                    {{ substr($vehicle->user->name, 0, 1) }}
                                </div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $vehicle->user->name }}</span>
                            </div>

                            @auth
                                @if ($vehicle->user->phone)
                                    <a href="tel:{{ $vehicle->user->phone }}"
                                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition shadow-md shadow-indigo-500/20">
                                        📞 Позвонить
                                    </a>
                                @else
                                    <span class="text-[10px] text-gray-400 italic">Нет тел.</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-[10px] text-indigo-500 underline">Вход для
                                    звонка</a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full text-center py-20 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-500 italic">На данный момент свободных машин нет.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
