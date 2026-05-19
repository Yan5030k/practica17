<script setup>
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    categorias: Array,
});

const form = useForm({
    nombre: '',
    autor: '',
    editorial: '',
    edicion: '',
    fecha_lanzamiento: '',
    imagen_portada: null,
    categoria_id: '',
});

const guardarLibro = () => {
    form.post('/libros', {
        forceFormData: true,
    });
};
</script>

<template>
    <div class="min-h-screen bg-[#f6efe6] text-[#1f1f1f]">
        <header class="bg-[#2b1d12] text-white shadow-lg">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
                <div>
                    <h1 class="text-3xl font-bold">
                        YansLibrary
                    </h1>
                    <p class="text-sm text-orange-200">
                        Registro de libros
                    </p>
                </div>

                <nav class="flex gap-3">
                    <Link href="/" class="rounded-lg bg-orange-500 px-4 py-2 font-semibold text-white hover:bg-orange-600">
                        Inicio
                    </Link>

                    <Link href="/categorias" class="rounded-lg bg-green-700 px-4 py-2 font-semibold text-white hover:bg-green-800">
                        Categorías
                    </Link>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-4xl px-6 py-10">
            <section class="rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="text-3xl font-bold text-[#2b1d12]">
                    Registrar nuevo libro
                </h2>

                <p class="mt-2 text-gray-700">
                    Completa el formulario para agregar un libro al inventario de la librería.
                </p>

                <div
                    v-if="categorias.length === 0"
                    class="mt-6 rounded-lg border border-orange-300 bg-orange-100 px-4 py-3 text-orange-900"
                >
                    Antes de registrar un libro debes crear al menos una categoría.
                </div>

                <form
                    v-else
                    @submit.prevent="guardarLibro"
                    class="mt-8 grid gap-5 md:grid-cols-2"
                >
                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Nombre del libro
                        </label>
                        <input
                            v-model="form.nombre"
                            type="text"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Nombre del libro"
                        />
                        <p v-if="form.errors.nombre" class="mt-1 text-sm text-red-600">
                            {{ form.errors.nombre }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Autor
                        </label>
                        <input
                            v-model="form.autor"
                            type="text"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Autor del libro"
                        />
                        <p v-if="form.errors.autor" class="mt-1 text-sm text-red-600">
                            {{ form.errors.autor }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Editorial
                        </label>
                        <input
                            v-model="form.editorial"
                            type="text"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Editorial"
                        />
                        <p v-if="form.errors.editorial" class="mt-1 text-sm text-red-600">
                            {{ form.errors.editorial }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Edición
                        </label>
                        <input
                            v-model="form.edicion"
                            type="text"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Ejemplo: Primera edición"
                        />
                        <p v-if="form.errors.edicion" class="mt-1 text-sm text-red-600">
                            {{ form.errors.edicion }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Fecha de lanzamiento
                        </label>
                        <input
                            v-model="form.fecha_lanzamiento"
                            type="date"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                        />
                        <p v-if="form.errors.fecha_lanzamiento" class="mt-1 text-sm text-red-600">
                            {{ form.errors.fecha_lanzamiento }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Categoría
                        </label>
                        <select
                            v-model="form.categoria_id"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                        >
                            <option value="">Seleccione una categoría</option>
                            <option
                                v-for="categoria in categorias"
                                :key="categoria.id"
                                :value="categoria.id"
                            >
                                {{ categoria.nombre }}
                            </option>
                        </select>
                        <p v-if="form.errors.categoria_id" class="mt-1 text-sm text-red-600">
                            {{ form.errors.categoria_id }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Imagen de portada
                        </label>
                        <input
                            type="file"
                            accept="image/*"
                            @input="form.imagen_portada = $event.target.files[0]"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-orange-500 focus:outline-none"
                        />
                        <p class="mt-1 text-sm text-gray-500">
                            Formatos permitidos: jpg, jpeg, png o webp. Tamaño máximo: 2 MB.
                        </p>
                        <p v-if="form.errors.imagen_portada" class="mt-1 text-sm text-red-600">
                            {{ form.errors.imagen_portada }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full rounded-lg bg-orange-500 px-5 py-3 font-bold text-white transition hover:bg-orange-600 disabled:opacity-60"
                        >
                            Guardar libro
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</template>