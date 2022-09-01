    <script src="{{ asset('js/vendor.js') }}" ></script>
    <script src="{{ asset('plugins/jquery-3.1.1.min.js') }}" ></script>
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}" ></script>
    <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}" ></script>

    <script>
        function noty(msg, option = 1){
            Snackbar.show({
                text:msg.toUpperCase(),
                actionText: 'CERRAR',
                actionTextColor: '#fff',
                backgroundColor: option == 1 ? '#1FC237' :
                    option == 2 ? '#e7515a' : option == 3 ? '#e2a03f' : '#1b55e2' ,
                pos: 'top-right'
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            window.livewire.on('noty-success', msg=>{
                noty(msg);
            });

            window.livewire.on('noty-danger', msg=>{
                noty(msg,2);
            });

            window.livewire.on('noty-warning', msg=>{
                noty(msg,3);
            });

            window.livewire.on('noty-primary', msg=>{
                noty(msg,4);
            });
        });
    </script>

    <script>
        function Confirm(msg,emit,id){
            id = id || 0;
            swal({
                title: 'Confirmar',
                text: '¿Confirmas eliminar '+msg+'?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonText: 'Aceptar'
            }).then(function(result){
                if(result.value){
                    if(id == 0){
                        window.livewire.emit(emit)
                    }else{
                        window.livewire.emit(emit,id)
                    }
                    swal.close()
                }
            })
        }
    </script>

    @stack('scripts')
    @livewireScripts
