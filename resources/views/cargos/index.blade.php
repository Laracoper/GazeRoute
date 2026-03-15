<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                🚚 Доступные грузы <span class="text-sm font-normal text-gray-500">(для 4м Газелей)</span>
            </h2>
            @auth
                <a href="{{ route('cargos.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                    + Разместить груз
                </a>
            @endauth
        </div>
    </x-slot>

    <!-- Фильтр поиска -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <form action="{{ route('cargos.index') }}" method="GET"
            class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Откуда</label>
                    <input type="text" name="from" value="{{ request('from') }}" placeholder="Город погрузки"
                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Куда</label>
                    <input type="text" name="to" value="{{ request('to') }}" placeholder="Город выгрузки"
                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-xl transition shadow-lg shadow-indigo-500/20">
                        Найти
                    </button>
                    @if (request()->anyFilled(['from', 'to']))
                        <a href="{{ route('cargos.index') }}"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-xl hover:bg-gray-300 transition text-center">
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
                @forelse ($cargos as $cargo)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 hover:shadow-xl transition-all duration-300 relative overflow-hidden group">
                        
                        <!-- Цена -->
                        <div class="absolute top-0 right-0 mt-4 mr-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1 rounded-full text-sm font-bold">
                            {{ number_format($cargo->price, 0, '.', ' ') }} ₽
                        </div>

                        <!-- Маршрут и Дата -->
                        <div class="flex items-start mb-6">
                            <div class="flex flex-col items-center mr-4">
                                <div class="w-3 h-3 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.6)]"></div>
                                <div class="w-0.5 h-10 bg-gradient-to-b from-indigo-500 to-emerald-500 my-1"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)]"></div>
                            </div>
                            <div class="flex flex-col gap-5 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Откуда</p>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white leading-tight">{{ $cargo->route_from }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-500 uppercase font-bold">Дата</p>
                                        <p class="text-xs font-semibold text-indigo-500 dark:text-indigo-400">
                                            📅 {{ $cargo->pickup_date ? $cargo->pickup_date->translatedFormat('d M') : 'Открытая' }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Куда</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white leading-tight">{{ $cargo->route_to }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Характеристики -->
                        <div class="grid grid-cols-3 gap-2 py-4 border-y border-gray-50 dark:border-gray-700/50 mb-4 text-center">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold">Вес</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $cargo->weight }} т</p>
                            </div>
                            <div class="border-x border-gray-50 dark:border-gray-700/50">
                                <p class="text-[10px] text-gray-500 uppercase font-bold">Объем</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $cargo->volume }} м³</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold">Длина</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $cargo->length }} м</p>
                            </div>
                        </div>

                        <!-- Футер -->
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <div class="w-8 h-8 flex-shrink-0 rounded-full bg-indigo-500 flex items-center justify-center text-xs font-bold text-white uppercase">
                                    {{ substr($cargo->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ $cargo->user->name }}</span>
                            </div>
                            
                            @auth
                                @if(Auth::id() === $cargo->user_id)
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 px-2 py-1 rounded font-bold uppercase">Мой</span>
                                        <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" onsubmit="return confirm('Удалить?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    @if($cargo->user->phone)
                                        <a href="tel:{{ $cargo->user->phone }}" class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-lg transition shadow-md shadow-green-500/20">
                                            📞 {{ $cargo->user->phone }}
                                        </a>
                                    @else
                                        <span class="text-[10px] text-gray-500 italic">Тел. нет</span>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-[10px] text-indigo-500 underline font-medium">Вход</a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-500">Грузов не найдено.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $cargos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
