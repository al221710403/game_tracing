<div class="min-h-screen text-white grid grid-cols-12 gap-2 py-4" style="background-color: #0A0D14;">
    <div class="col-span-2 bg-red-400">
        <div class="flex flex-col">

            <div class="basis-1/4 bg-green-400">01</div>
        </div>
    </div>
    <div class="col-span-10">
        <section class="px-4">
            <h2 class="text-center text-lg">Traductor</h2>
            <div>
                <label for="source" class="block mb-2 text-sm font-medium">Ingrese el texto a traducir</label>
                <textarea id="source" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Texto a traducir..."></textarea>
            </div>

            <div class="mt-4">
                <label for="target" class="block mb-2 text-sm font-medium">Texto traducido</label>
                <textarea id="target" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$traslate_target}}</textarea>
            </div>

            <button class="py-2 px-3 rounded-lg mt-4" onclick="getTraslate()" type="button" style="background: #215BF0;">Traducir</button>
        </section>
    </div>
</div>


@push('scripts')
    <script>
        function getTraslate(){
            console.log('hola descde consola');
        }
    </script>
@endpush
