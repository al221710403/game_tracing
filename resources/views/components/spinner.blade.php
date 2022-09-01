{{--  <div wire:loading>  --}}
<div wire:loading.delay.longest>
    <div class="absolute inset-0 min-h-screen w-full text-white flex justify-center items-center"  style="background-color: rgba(0, 0, 0, 0.8); z-index: 99;">
        <div class="relative bg-white opacity-100 h-1/3 w-1/3 flex flex-col justify-center items-center rounded">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <h2 class="text-black text-2xl mb-5 font-bold">Cargando...</h2>
        </div>
    </div>
</div>
