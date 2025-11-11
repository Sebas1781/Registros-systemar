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
                                                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" onclick="closeModal({{ $registration->id }})">
                                                    <div class="relative top-20 mx-auto p-8 border w-11/12 max-w-4xl shadow-lg rounded-lg bg-white" onclick="event.stopPropagation()">
                                                        <div class="flex justify-between items-start mb-6">
                                                            <h3 class="text-2xl font-bold text-gray-900">Detalles del Registro</h3>
                                                            <button onclick="closeModal({{ $registration->id }})" class="text-gray-400 hover:text-gray-600">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="flex gap-6">
                                                            @if($registration->fotografia)
                                                                <div class="flex-shrink-0">
                                                                    <img
                                                                        src="{{ asset('storage/' . $registration->fotografia) }}"
                                                                        alt="Foto de {{ $registration->nombre }}"
                                                                        class="w-48 h-48 rounded-lg object-cover border-2 border-gray-300 shadow-md"
                                                                    >
                                                                </div>
                                                            @endif

                                                            <div class="flex-1">
                                                                <h4 class="text-xl font-bold text-gray-900 mb-2">
                                                                    {{ $registration->nombre }} {{ $registration->apellido_paterno }} {{ $registration->apellido_materno }}
                                                                </h4>
                                                                <p class="text-sm text-gray-600 mb-4">CURP: {{ $registration->curp }}</p>

                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                                    <div>
                                                                        <p class="text-xs font-semibold text-gray-500 uppercase">Teléfono</p>
                                                                        <p class="text-sm text-gray-900">{{ $registration->telefono }}</p>
                                                                    </div>

                                                                    <div>
                                                                        <p class="text-xs font-semibold text-gray-500 uppercase">Email</p>
                                                                        <p class="text-sm text-gray-900">{{ $registration->email }}</p>
                                                                    </div>

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
                                                                <div class="mb-4">
                                                                    <p class="text-xs font-semibold text-gray-500 uppercase">Detalle de Experiencia</p>
                                                                    <p class="text-sm text-gray-900">{{ $registration->detalle_experiencia }}</p>
                                                                </div>
                                                                @endif

                                                                <div class="mb-4">
                                                                    <p class="text-xs font-semibold text-gray-500 uppercase">Secciones para Desarrollarse</p>
                                                                    <p class="text-sm text-gray-900">{{ $registration->secciones_desarrollarse }}</p>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <p class="text-xs font-semibold text-gray-500 uppercase">¿Por qué se propone?</p>
                                                                    <p class="text-sm text-gray-900">{{ $registration->por_que_propone }}</p>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <p class="text-xs font-semibold text-gray-500 uppercase">Corriente Política</p>
                                                                    <p class="text-sm text-gray-900">{{ $registration->corriente_politica }}</p>
                                                                </div>

                                                                <div class="flex justify-between items-center text-xs text-gray-500 pt-4 border-t">
                                                                    <span>ID: {{ $registration->id }}</span>
                                                                    @if($registration->user)
                                                                        <span>Registrado por: {{ $registration->user->name }} {{ $registration->user->apellido_paterno }}</span>
                                                                    @endif
                                                                    <span>{{ $registration->created_at->format('d/m/Y H:i') }}</span>
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
