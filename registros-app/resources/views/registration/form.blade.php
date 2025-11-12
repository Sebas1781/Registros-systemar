<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulario de Registro') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">
                Formulario
            </h2>
            <p class="text-center text-gray-600 mb-8">Complete todos los campos requeridos</p>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nombres -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">
                            Nombre <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            value="{{ old('nombre') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">
                            Apellido Paterno <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="apellido_paterno"
                            id="apellido_paterno"
                            value="{{ old('apellido_paterno') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('apellido_paterno')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="apellido_materno" class="block text-sm font-medium text-gray-700">
                            Apellido Materno <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="apellido_materno"
                            id="apellido_materno"
                            value="{{ old('apellido_materno') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('apellido_materno')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Teléfono y Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">
                            Número Telefónico <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="telefono"
                            id="telefono"
                            value="{{ old('telefono') }}"
                            pattern="[0-9]*"
                            maxlength="10"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('telefono')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Correo Electrónico <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Fotografía -->
                <div>
                    <label for="fotografia" class="block text-sm font-medium text-gray-700">
                        Fotografía
                    </label>
                    <input
                        type="file"
                        name="fotografia"
                        id="fotografia"
                        accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                    >
                    <p class="mt-1 text-xs text-gray-500">Tamaño máximo: 5MB. Formatos permitidos: JPG, PNG, GIF</p>
                    @error('fotografia')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CURP -->
                <div>
                    <label for="curp" class="block text-sm font-medium text-gray-700">
                        CURP <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="curp"
                        id="curp"
                        value="{{ old('curp') }}"
                        maxlength="18"
                        pattern="[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9A-Z]{2}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 uppercase"
                        required
                    >
                    <p class="mt-1 text-xs text-gray-500">Formato: 4 letras, 6 dígitos, H/M, 5 letras, 2 caracteres</p>
                    @error('curp')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="md:col-span-2">
                        <label for="calle" class="block text-sm font-medium text-gray-700">
                            Calle/Av. <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="calle"
                            id="calle"
                            value="{{ old('calle') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('calle')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="manzana" class="block text-sm font-medium text-gray-700">
                            Mz.
                        </label>
                        <input
                            type="text"
                            name="manzana"
                            id="manzana"
                            value="{{ old('manzana') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label for="lote" class="block text-sm font-medium text-gray-700">
                            Lte.
                        </label>
                        <input
                            type="text"
                            name="lote"
                            id="lote"
                            value="{{ old('lote') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label for="numero" class="block text-sm font-medium text-gray-700">
                            No.
                        </label>
                        <input
                            type="text"
                            name="numero"
                            id="numero"
                            value="{{ old('numero') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label for="codigo_postal" class="block text-sm font-medium text-gray-700">
                            C.P. <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="codigo_postal"
                            id="codigo_postal"
                            value="{{ old('codigo_postal') }}"
                            maxlength="5"
                            pattern="[0-9]{5}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="12345"
                            required
                        >
                        @error('codigo_postal')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Municipio -->
                <div>
                    <label for="municipio" class="block text-sm font-medium text-gray-700">
                        Municipio <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="municipio"
                        id="municipio"
                        value="{{ old('municipio') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >
                    @error('municipio')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sección electoral -->
                <div>
                    <label for="seccion_electoral" class="block text-sm font-medium text-gray-700">
                        Sección electoral <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="seccion_electoral"
                        id="seccion_electoral"
                        value="{{ old('seccion_electoral') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >
                    @error('seccion_electoral')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ocupación actual -->
                <div>
                    <label for="ocupacion_actual" class="block text-sm font-medium text-gray-700">
                        Ocupación actual <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="ocupacion_actual"
                        id="ocupacion_actual"
                        value="{{ old('ocupacion_actual') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >
                    @error('ocupacion_actual')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Experiencia -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Experiencia <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center">
                            <input
                                type="radio"
                                name="experiencia"
                                value="Si"
                                {{ old('experiencia') == 'Si' ? 'checked' : '' }}
                                class="rounded-full border-gray-300 text-emerald-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                required
                                onchange="toggleDetalleExperiencia()"
                            >
                            <span class="ml-2">Sí</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input
                                type="radio"
                                name="experiencia"
                                value="No"
                                {{ old('experiencia') == 'No' ? 'checked' : '' }}
                                class="rounded-full border-gray-300 text-emerald-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                onchange="toggleDetalleExperiencia()"
                            >
                            <span class="ml-2">No</span>
                        </label>
                    </div>
                    @error('experiencia')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detalla experiencia -->
                <div id="detalle_experiencia_container" class="overflow-hidden transition-all duration-500 ease-in-out" style="max-height: 0; opacity: 0;">
                    <label for="detalle_experiencia" class="block text-sm font-medium text-gray-700">
                        Detalla experiencia
                    </label>
                    <textarea
                        name="detalle_experiencia"
                        id="detalle_experiencia"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                    >{{ old('detalle_experiencia') }}</textarea>
                    @error('detalle_experiencia')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Secciones electorales para desarrollarse -->
                <div>
                    <label for="secciones_desarrollarse" class="block text-sm font-medium text-gray-700">
                        Secciones electorales para desarrollarse <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="secciones_desarrollarse"
                        id="secciones_desarrollarse"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >{{ old('secciones_desarrollarse') }}</textarea>
                    @error('secciones_desarrollarse')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ¿Por qué se propone? -->
                <div>
                    <label for="por_que_propone" class="block text-sm font-medium text-gray-700">
                        ¿Por qué se propone? <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="por_que_propone"
                        id="por_que_propone"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >{{ old('por_que_propone') }}</textarea>
                    @error('por_que_propone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ¿Forma parte de alguna corriente política? -->
                <div>
                    <label for="corriente_politica" class="block text-sm font-medium text-gray-700">
                        ¿Forma parte de alguna corriente política? <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="corriente_politica"
                        id="corriente_politica"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        required
                    >{{ old('corriente_politica') }}</textarea>
                    @error('corriente_politica')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg"
                    >
                        Enviar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleDetalleExperiencia() {
        const experienciaRadios = document.getElementsByName('experiencia');
        const detalleContainer = document.getElementById('detalle_experiencia_container');
        const detalleTextarea = document.getElementById('detalle_experiencia');

        let selectedValue = null;
        for (const radio of experienciaRadios) {
            if (radio.checked) {
                selectedValue = radio.value;
                break;
            }
        }

        if (selectedValue === 'Si') {
            // Mostrar con animación de deslizamiento
            detalleContainer.style.maxHeight = '200px';
            detalleContainer.style.opacity = '1';
            detalleContainer.style.marginTop = '1.5rem';
        } else {
            // Ocultar con animación de deslizamiento
            detalleContainer.style.maxHeight = '0';
            detalleContainer.style.opacity = '0';
            detalleContainer.style.marginTop = '0';
            detalleTextarea.value = ''; // Limpiar el campo si se selecciona "No"
        }
    }

    // Ejecutar al cargar la página para manejar valores antiguos (old)
    document.addEventListener('DOMContentLoaded', function() {
        toggleDetalleExperiencia();
    });
</script>
    </div>
</div>
</x-app-layout>
