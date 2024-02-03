<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-xl text-gray-800 dark:text-white my-3">
            {{ $vacante -> titulo }}
        </h3>
        <div class="md:grid md:grid-cols-2 bg-gray-50 dark:bg-gray-700 p-4 my-10 rounded-lg">
            <p class="font-bold text-sm uppercase text-gray-800 dark:text-gray-400 my-3">Empresa:
                <span class="normal-case font-normal">{{ $vacante -> empresa }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 dark:text-gray-400 my-3">Ultimo dia para postularse:
                <span class="normal-case font-normal">{{ $vacante -> ultimo_dia -> toFormattedDateString() }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 dark:text-gray-400 my-3">Categoria:
                <span class="normal-case font-normal">{{ $vacante -> categoria -> categoria }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 dark:text-gray-400 my-3">Salario:
                <span class="normal-case font-normal">{{ $vacante -> salario -> salario }}</span>
            </p>
        </div>
    </div>
    {{-- divido la imagen y descripcion en 6 columnas --}}
    <div class="md:grid md:grid-cols-6 gap-4">
        {{-- primer div toma 2 --}}
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante -> imagen) }}" alt="{{ 'Imagen Vacante' . $vacante -> titulo }}">
        </div>
        {{-- segundo div toma 4 --}}
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5 dark:text-white">Descripcion del puesto</h2>
            <p>{{ $vacante -> descripcion }}</p>
        </div>
    </div>
    {{-- no autenticado --}}
    @guest
        <div class="mt-5 bg-gray-50 border dark:bg-gray-600 border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta Vacante? <a class="font-bold text-indigo-600 dark:text-indigo-500" href="{{ route('register') }}">Obten una cuenta y aplica a esta y a otras vacantes</a>
            </p>
        </div>
    @endguest

    {{-- Un usuario puede --}}
    {{-- VacantePolicy {create} --}}
    {{-- este es un Desarrollador --}}
    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante" />
    @endcannot



</div>
