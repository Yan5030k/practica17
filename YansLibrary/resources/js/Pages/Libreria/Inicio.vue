<script setup>
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    libros: Array,
});

const page = usePage();
</script>

<template>
    <div class="min-h-screen bg-[#f6efe6] text-[#1f1f1f]">
        <header class="bg-[#2b1d12] text-white shadow-lg">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
                <div>
                    <h1 class="text-3xl font-bold tracking-wide">
                        YansLibrary
                    </h1>
                    <p class="text-sm text-orange-200">
                        Inventario digital para una librería
                    </p>
                </div>

                <nav class="flex gap-3">
                    <Link
                        href="/"
                        class="rounded-lg bg-orange-500 px-4 py-2 font-semibold text-white transition hover:bg-orange-600"
                    >
                        Inicio
                    </Link>

                    <Link
                        href="/categorias"
                        class="rounded-lg bg-green-700 px-4 py-2 font-semibold text-white transition hover:bg-green-800"
                    >
                        Categorías
                    </Link>

                    <Link
                        href="/libros/crear"
                        class="rounded-lg border border-white px-4 py-2 font-semibold text-white transition hover:bg-white hover:text-[#2b1d12]"
                    >
                        Registrar libro
                    </Link>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <section class="mb-8 rounded-2xl bg-white p-8 shadow-md">
                <h2 class="text-4xl font-bold text-[#2b1d12]">
                    Catálogo principal de libros
                </h2>
                <p class="mt-3 max-w-3xl text-gray-700">
                    En esta página se muestran los libros registrados en el inventario,
                    junto con su autor, editorial, edición, fecha de lanzamiento, portada
                    y la categoría relacionada.
                </p>

                <div
                    v-if="page.props.flash?.success"
                    class="mt-5 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800"
                >
                    {{ page.props.flash.success }}
                </div>
            </section>

            <section v-if="libros.length > 0" class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <article
                    v-for="libro in libros"
                    :key="libro.id"
                    class="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl"
                >
                    <div class="flex h-80 items-center justify-center bg-[#e8dac8] p-4">
                        <img
                            :src="`/storage/${libro.imagen_portada}`"
                            :alt="libro.nombre"
                            class="max-h-full max-w-full object-contain"
                        />
                    </div>

                    <div class="p-6">
                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-bold text-green-800">
                            {{ libro.categoria.nombre }}
                        </span>

                        <h3 class="mt-4 text-2xl font-bold text-[#2b1d12]">
                            {{ libro.nombre }}
                        </h3>

                        <div class="mt-4 space-y-2 text-sm text-gray-700">
                            <p><strong>Autor:</strong> {{ libro.autor }}</p>
                            <p><strong>Editorial:</strong> {{ libro.editorial }}</p>
                            <p><strong>Edición:</strong> {{ libro.edicion }}</p>
                            <p><strong>Fecha de lanzamiento:</strong> {{ libro.fecha_lanzamiento }}</p>
                        </div>

                        <div class="mt-5 rounded-lg bg-orange-50 p-4">
                            <p class="text-sm font-semibold text-orange-800">
                                Descripción de categoría:
                            </p>
                            <p class="mt-1 text-sm text-gray-700">
                                {{ libro.categoria.descripcion }}
                            </p>
                        </div>
                    </div>
                </article>
            </section>

            <section
                v-else
                class="rounded-2xl border-2 border-dashed border-orange-400 bg-white p-10 text-center shadow-md"
            >
                <h3 class="text-2xl font-bold text-[#2b1d12]">
                    Todavía no hay libros registrados
                </h3>
                <p class="mt-3 text-gray-700">
                    Primero registra una categoría y luego registra un libro relacionado a esa categoría.
                </p>

                <div class="mt-6 flex justify-center gap-4">
                    <Link
                        href="/categorias"
                        class="rounded-lg bg-green-700 px-5 py-3 font-semibold text-white hover:bg-green-800"
                    >
                        Registrar categoría
                    </Link>

                    <Link
                        href="/libros/crear"
                        class="rounded-lg bg-orange-500 px-5 py-3 font-semibold text-white hover:bg-orange-600"
                    >
                        Registrar libro
                    </Link>
                </div>
            </section>
        </main>
    </div>
</template>