<div class="">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        @forelse($vacantes as $vacante)
            <div class="p-6 text-gray-900 dark:text-gray-200 md:flex md:justify-between">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante-> id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">
                        {{ $vacante->empresa }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Ultimo dia:
                        <span class="text-gray-400">{{ $vacante->ultimo_dia->format('d/m/Y') }}</span>
                    </p>
                </div>
                <div class="flex flex-col gap-3 mt-2 md:flex-row md:items-center">
                    <a href="{{ route('candidatos.index', $vacante) }}"
                        class="bg-slate-800 dark:bg-slate-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        {{ $vacante -> candidatos -> count() }}
                        Candidatos
                    </a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 dark:bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Editar
                    </a>
                    <button type="button" wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-800 dark:bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Eliminar

                    </button>
                </div>
            </div>

        @empty
            <p class="p-3 text-center text-sm text-gray-600 dark:text-gray-300">No hay Vacantes que mostrar...</p>
        @endforelse

    </div>

    @if (count($vacantes) > 0)
        <div class="mt-10">
            {{ $vacantes->links() }}
        </div>
    @endif
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('mostrarAlerta', (vacanteId) => {
                Swal.fire({
                    title: '¿Eliminar Vacante?',
                    text: "Una Vacante eliminada no se puede recuperar:(",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ELiminar vacante
                        @this.call('eliminarVacante', vacanteId);
                        Swal.fire(
                            'Se eliminó la Vacante',
                            'Eliminado correctamente',
                            'success'
                        )
                    }
                })

            });
        });
    </script>
@endpush
