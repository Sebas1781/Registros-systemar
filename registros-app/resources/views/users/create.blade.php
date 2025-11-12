<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Crear Nuevo Usuario</h2>
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Volver
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre completo -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Datos Personales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno *</label>
                                    <input type="text" name="apellido_paterno" id="apellido_paterno" value="{{ old('apellido_paterno') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido Materno *</label>
                                    <input type="text" name="apellido_materno" id="apellido_materno" value="{{ old('apellido_materno') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- CURP -->
                        <div class="mb-6">
                            <label for="curp" class="block text-sm font-medium text-gray-700">CURP *</label>
                            <input type="text" name="curp" id="curp" value="{{ old('curp') }}" maxlength="18" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="18 caracteres">
                        </div>

                        <!-- Fotografía -->
                        <div class="mb-6">
                            <label for="fotografia" class="block text-sm font-medium text-gray-700">Fotografía</label>
                            <input type="file" name="fotografia" id="fotografia" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <p class="mt-1 text-xs text-gray-500">Tamaño máximo: 5MB. Formatos permitidos: JPG, PNG, GIF</p>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Credenciales de Acceso</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña *</label>
                                    <input type="password" name="password" id="password" required minlength="8"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Mínimo 8 caracteres">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña *</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Repetir contraseña">
                                </div>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Dirección</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="md:col-span-2">
                                    <label for="calle" class="block text-sm font-medium text-gray-700">Calle/Av. *</label>
                                    <input type="text" name="calle" id="calle" value="{{ old('calle') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div>
                                    <label for="manzana" class="block text-sm font-medium text-gray-700">Mz. *</label>
                                    <input type="text" name="manzana" id="manzana" value="{{ old('manzana') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="lote" class="block text-sm font-medium text-gray-700">Lte. *</label>
                                    <input type="text" name="lote" id="lote" value="{{ old('lote') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="numero" class="block text-sm font-medium text-gray-700">No. *</label>
                                    <input type="text" name="numero" id="numero" value="{{ old('numero') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="codigo_postal" class="block text-sm font-medium text-gray-700">Código Postal *</label>
                                    <input type="text" name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal') }}" maxlength="5" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                            <div>
                                <label for="municipio" class="block text-sm font-medium text-gray-700">Municipio *</label>
                                <input type="text" name="municipio" id="municipio" value="{{ old('municipio') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        </div>

                        <!-- Información Electoral y Contacto -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Información Electoral y Contacto</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="seccion_electoral" class="block text-sm font-medium text-gray-700">Sección Electoral *</label>
                                    <input type="number" name="seccion_electoral" id="seccion_electoral" value="{{ old('seccion_electoral') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="telefono" class="block text-sm font-medium text-gray-700">Número Telefónico *</label>
                                    <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">
                                Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
