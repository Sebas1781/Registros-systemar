<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Total de registros: {{ $registrations->total() }}</h3>
                    </div>

                    @if($registrations->count() > 0)
                        <div class="space-y-4">
                            @foreach($registrations as $registration)
                                <div class="bg-gray-50 rounded-lg p-6 shadow">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-start gap-4 flex-1">
                                            @if($registration->fotografia)
                                                <div class="flex-shrink-0">
                                                    <img
                                                        src="{{ asset('storage/' . $registration->fotografia) }}"
                                                        alt="Foto de {{ $registration->nombre }}"
                                                        class="w-32 h-32 rounded-lg object-cover border-2 border-gray-300 shadow-md"
                                                        style="width: 128px; height: 128px;"
                                                    >
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <h3 class="text-lg font-bold text-gray-900">
                                                    {{ $registration->nombre }} {{ $registration->apellido_paterno }} {{ $registration->apellido_materno }}
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">CURP: {{ $registration->curp }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end gap-1">
                                            <span class="text-xs text-gray-500">ID: {{ $registration->id }}</span>
                                            @if($registration->user)
                                                <span class="text-xs text-gray-500">
                                                    Registrado por: {{ $registration->user->name }} {{ $registration->user->apellido_paterno }}
                                                </span>
                                            @endif
                                            <form action="{{ route('dashboard.destroy', $registration->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase">Dirección</p>
                                            <p class="text-sm text-gray-900">
                                                {{ $registration->calle }}
                                                @if($registration->manzana) Mz. {{ $registration->manzana }} @endif
                                                @if($registration->lote) Lt. {{ $registration->lote }} @endif
                                                @if($registration->numero) #{{ $registration->numero }} @endif
                                            </p>
                                            <p class="text-sm text-gray-900">CP: {{ $registration->codigo_postal }}, {{ $registration->municipio }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase">Sección Electoral</p>
                                            <p class="text-sm text-gray-900">{{ $registration->seccion_electoral }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase">Ocupación</p>
                                            <p class="text-sm text-gray-900">{{ $registration->ocupacion_actual }}</p>
                                        </div>

                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase">Experiencia</p>
                                            <p class="text-sm text-gray-900">{{ $registration->experiencia }}</p>
                                        </div>
                                    </div>

                                    @if($registration->detalle_experiencia)
                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Detalle de Experiencia</p>
                                        <p class="text-sm text-gray-900">{{ $registration->detalle_experiencia }}</p>
                                    </div>
                                    @endif

                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Secciones para Desarrollarse</p>
                                        <p class="text-sm text-gray-900">{{ $registration->secciones_desarrollarse }}</p>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase">¿Por qué se propone?</p>
                                        <p class="text-sm text-gray-900">{{ $registration->por_que_propone }}</p>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Corriente Política</p>
                                        <p class="text-sm text-gray-900">{{ $registration->corriente_politica }}</p>
                                    </div>

                                    <div class="mt-4 text-xs text-gray-500">
                                        Registrado: {{ $registration->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $registrations->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No hay registros todavía.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
