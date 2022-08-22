{{--  <div x-data="{ modelOpen: true }">  --}}
<div x-cloak x-data="{ modelOpen: @entangle('showModal') }">
    <div x-show="modelOpen" class="absolute inset-0 z-10 overflow-y-auto bg-black" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-10 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">Corrección de coincidencia</h1>
                    {{--  <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>  --}}
                </div>

                <p class="mt-2 text-sm text-gray-400 ">
                    Se ha encontrado una coincidencia de una validación, favor de indicar que hacer con la coincidencia.
                </p>

                <form class="mt-5">
                    <div>
                        <label class="block text-sm text-gray-700 capitalize">Coincidencia</label>
                        <textarea wire:model="matchSource" rows="2" class="block w-full px-3 py-2 mt-2 text-gray-600 bg-gray-200 border border-gray-200 rounded-md text-sm" disabled></textarea>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm text-gray-700 capitalize">Traducción</label>
                        <textarea wire:model="matchTarget" rows="2" class="block w-full px-3 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40 text-sm"></textarea>
                    </div>

                    {{--  <div class="mt-4">
                        <h1 class="text-xs font-medium text-gray-400 uppercase">Acciones</h1>

                        <div class="mt-4 space-y-5">
                            <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                                @click="show =!show">
                                <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                    :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                    <label for="show" @click="show =!show"
                                        class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                        :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                    <input type="checkbox" name="show"
                                        class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                </div>

                                <p class="text-gray-500">Can make task</p>
                            </div>

                            <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: false }"
                                @click="show =!show">
                                <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                    :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                    <label for="show" @click="show =!show"
                                        class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                        :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                    <input type="checkbox" name="show"
                                        class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                </div>

                                <p class="text-gray-500">Can delete task</p>
                            </div>

                            <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                                @click="show =!show">
                                <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                    :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                    <label for="show" @click="show =!show"
                                        class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                        :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                    <input type="checkbox" name="show"
                                        class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                </div>

                                <p class="text-gray-500">Can edit task</p>
                            </div>
                        </div>
                    </div>  --}}

                    <p class="mt-2 text-xs text-gray-400 ">
                        Nota: No olvidar que la traducción debe de ir encerrado en comillas dobles <code class="text-red-500">"Traducción"</code> para que la traducción se realize sin errores.
                    </p>

                    <div class="flex justify-end mt-6">
                        <button type="button" class="mr-5 px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-400 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                            Ignorar
                        </button>
                        <button type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-400 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            Traducir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
