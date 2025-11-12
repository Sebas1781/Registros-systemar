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
                    <div class="mb-6 text-center">
                        <h3 class="text-lg font-semibold">Total de registros: {{ $registrations->total() }}</h3>
                    </div>

                    @if($registrations->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Registro</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($registrations as $registration)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 text-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $registration->nombre }} {{ $registration->apellido_paterno }} {{ $registration->apellido_materno }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $registration->curp }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="text-sm text-gray-900">
                                                    {{ $registration->calle }}
                                                    @if($registration->manzana) Mz. {{ $registration->manzana }} @endif
                                                    @if($registration->lote) Lt. {{ $registration->lote }} @endif
                                                    @if($registration->numero) #{{ $registration->numero }} @endif
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $registration->municipio }}, CP {{ $registration->codigo_postal }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                {{ $registration->telefono ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                                {{ $registration->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm font-medium">
                                                <div class="flex items-center justify-center gap-3">
                                                    <button
                                                        onclick="openModal({{ $registration->id }})"
                                                        class="text-emerald-600 hover:text-emerald-900"
                                                        title="Ver detalles"
                                                    >
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </button>
                                                    <form action="{{ route('dashboard.destroy', $registration->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal para cada registro -->
                                        <tr id="modal-{{ $registration->id }}" class="hidden">
                                            <td colspan="5" class="p-0">
                                                <div class="fixed inset-0 bg-black bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-0 sm:p-4">
                                                    <div class="relative w-full h-full sm:h-auto sm:max-w-2xl sm:max-h-[95vh] overflow-y-auto bg-white sm:rounded-xl shadow-2xl" onclick="event.stopPropagation()">

                                                        <!-- Botón cerrar en la esquina -->
                                                        <button
                                                            onclick="closeModal({{ $registration->id }})"
                                                            class="absolute top-2 right-2 z-50 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-bold shadow-lg active:scale-95 transition-all"
                                                        >
                                                            ✕
                                                        </button>

                                                        <!-- Header del modal -->
                                                        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 pt-10 pb-4 px-4 sm:rounded-t-xl">
                                                            <h3 class="text-base sm:text-lg font-bold text-white text-center">Detalles del Registro</h3>
                                                        </div>

                                                        <!-- Contenido del modal -->
                                                        <div class="p-5 sm:p-6">
                                                            @if($registration->fotografia)
                                                                <div class="mb-6 flex justify-center">
                                                                    <img
                                                                        src="{{ asset('storage/' . $registration->fotografia) }}"
                                                                        alt="Foto de {{ $registration->nombre }}"
                                                                        class="w-48 h-56 sm:w-56 sm:h-64 rounded-xl object-cover border-4 border-emerald-500 shadow-xl"
                                                                    >
                                                                </div>
                                                            @endif

                                                            <div>
                                                                <h4 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 text-center">
                                                                    {{ $registration->nombre }} {{ $registration->apellido_paterno }} {{ $registration->apellido_materno }}
                                                                </h4>
                                                                <p class="text-sm sm:text-base text-gray-600 mb-6 text-center font-mono">{{ $registration->curp }}</p>

                                                                <div class="space-y-4">
                                                                    <div class="bg-gradient-to-r from-emerald-50 to-white rounded-lg p-4 border-l-4 border-emerald-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-emerald-700 uppercase mb-1">Teléfono</p>
                                                                        <p class="text-base sm:text-lg text-gray-900 font-semibold">{{ $registration->telefono }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-emerald-50 to-white rounded-lg p-4 border-l-4 border-emerald-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-emerald-700 uppercase mb-1">Email</p>
                                                                        <p class="text-base sm:text-lg text-gray-900 break-all">{{ $registration->email }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-emerald-50 to-white rounded-lg p-4 border-l-4 border-emerald-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-emerald-700 uppercase mb-1">Sección Electoral</p>
                                                                        <p class="text-base sm:text-lg text-gray-900 font-semibold">{{ $registration->seccion_electoral }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-blue-50 to-white rounded-lg p-4 border-l-4 border-blue-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-blue-700 uppercase mb-1">Experiencia</p>
                                                                        <p class="text-base sm:text-lg text-gray-900 font-semibold">{{ $registration->experiencia }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-purple-50 to-white rounded-lg p-4 border-l-4 border-purple-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-purple-700 uppercase mb-1">Dirección</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">
                                                                            {{ $registration->calle }}
                                                                            @if($registration->manzana) Mz. {{ $registration->manzana }} @endif
                                                                            @if($registration->lote) Lt. {{ $registration->lote }} @endif
                                                                            @if($registration->numero) #{{ $registration->numero }} @endif
                                                                        </p>
                                                                        <p class="text-base sm:text-lg text-gray-900 mt-1">CP: {{ $registration->codigo_postal }}, {{ $registration->municipio }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-orange-50 to-white rounded-lg p-4 border-l-4 border-orange-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-orange-700 uppercase mb-1">Ocupación</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">{{ $registration->ocupacion_actual }}</p>
                                                                    </div>

                                                                    @if($registration->detalle_experiencia)
                                                                    <div class="bg-gradient-to-r from-indigo-50 to-white rounded-lg p-4 border-l-4 border-indigo-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-indigo-700 uppercase mb-1">Detalle de Experiencia</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">{{ $registration->detalle_experiencia }}</p>
                                                                    </div>
                                                                    @endif

                                                                    <div class="bg-gradient-to-r from-teal-50 to-white rounded-lg p-4 border-l-4 border-teal-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-teal-700 uppercase mb-1">Secciones para Desarrollarse</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">{{ $registration->secciones_desarrollarse }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-pink-50 to-white rounded-lg p-4 border-l-4 border-pink-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-pink-700 uppercase mb-1">¿Por qué se propone?</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">{{ $registration->por_que_propone }}</p>
                                                                    </div>

                                                                    <div class="bg-gradient-to-r from-red-50 to-white rounded-lg p-4 border-l-4 border-red-500 shadow-sm">
                                                                        <p class="text-xs font-bold text-red-700 uppercase mb-1">Corriente Política</p>
                                                                        <p class="text-base sm:text-lg text-gray-900">{{ $registration->corriente_politica }}</p>
                                                                    </div>

                                                                    <div class="bg-gray-100 rounded-xl p-4 border border-gray-300 mt-6">
                                                                        <div class="grid grid-cols-1 gap-2 text-sm text-gray-700">
                                                                            <div class="flex items-center gap-2">
                                                                                <span class="font-bold text-gray-900">ID:</span>
                                                                                <span>{{ $registration->id }}</span>
                                                                            </div>
                                                                            @if($registration->user)
                                                                            <div class="flex items-start gap-2">
                                                                                <span class="font-bold text-gray-900 whitespace-nowrap">Registrado por:</span>
                                                                                <span>{{ $registration->user->name }} {{ $registration->user->apellido_paterno }}</span>
                                                                            </div>
                                                                            @endif
                                                                            <div class="flex items-center gap-2">
                                                                                <span class="font-bold text-gray-900">Fecha:</span>
                                                                                <span>{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Botón de cerrar grande y visible -->
                                                                    <div class="mt-6 pb-4">
                                                                        <button
                                                                            onclick="closeModal({{ $registration->id }})"
                                                                            class="w-full bg-black hover:bg-gray-900 active:scale-95 text-white font-bold text-xl py-5 px-6 rounded-2xl transition-all duration-200 shadow-2xl hover:shadow-3xl flex items-center justify-center gap-3"
                                                                        >
                                                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                            </svg>
                                                                            CERRAR
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('[id^="modal-"]');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                });
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</x-app-layout>
