<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    categorias: Array,
});

const page = usePage();

const form = useForm({
    nombre: '',
    descripcion: '',
});

const guardarCategoria = () => {
    form.post('/categorias', {
        onSuccess: () => {
            form.reset();
        },
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
                        Registro de categorías
                    </p>
                </div>

                <nav class="flex gap-3">
                    <Link href="/" class="rounded-lg bg-orange-500 px-4 py-2 font-semibold text-white hover:bg-orange-600">
                        Inicio
                    </Link>

                    <Link href="/libros/crear" class="rounded-lg bg-green-700 px-4 py-2 font-semibold text-white hover:bg-green-800">
                        Registrar libro
                    </Link>
                </nav>
            </div>
        </header>

        <main class="mx-auto grid max-w-7xl gap-8 px-6 py-10 lg:grid-cols-2">
            <section class="rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="text-3xl font-bold text-[#2b1d12]">
                    Nueva categoría
                </h2>

                <p class="mt-2 text-gray-700">
                    Las categorías deben registrarse antes de crear libros, porque cada libro debe pertenecer a una categoría.
                </p>

                <div
                    v-if="page.props.flash?.success"
                    class="mt-5 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800"
                >
                    {{ page.props.flash.success }}
                </div>

                <form @submit.prevent="guardarCategoria" class="mt-6 space-y-5">
                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Nombre de la categoría
                        </label>
                        <input
                            v-model="form.nombre"
                            type="text"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Ejemplo: Novela, Historia, Programación"
                        />
                        <p v-if="form.errors.nombre" class="mt-1 text-sm text-red-600">
                            {{ form.errors.nombre }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block font-semibold text-[#2b1d12]">
                            Descripción
                        </label>
                        <textarea
                            v-model="form.descripcion"
                            rows="5"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-orange-500 focus:outline-none"
                            placeholder="Describe brevemente esta categoría"
                        ></textarea>
                        <p v-if="form.errors.descripcion" class="mt-1 text-sm text-red-600">
                            {{ form.errors.descripcion }}
                        </p>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-lg bg-orange-500 px-5 py-3 font-bold text-white transition hover:bg-orange-600 disabled:opacity-60"
                    >
                        Guardar categoría
                    </button>
                </form>
            </section>

            <section class="rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="text-3xl font-bold text-[#2b1d12]">
                    Categorías registradas
                </h2>

                <div v-if="categorias.length > 0" class="mt-6 space-y-4">
                    <article
                        v-for="categoria in categorias"
                        :key="categoria.id"
                        class="rounded-xl border-l-8 border-green-700 bg-[#fbf7f1] p-5 shadow-sm"
                    >
                        <h3 class="text-xl font-bold text-[#2b1d12]">
                            {{ categoria.nombre }}
                        </h3>
                        <p class="mt-2 text-gray-700">
                            {{ categoria.descripcion }}
                        </p>
                    </article>
                </div>

                <div v-else class="mt-6 rounded-xl border-2 border-dashed border-orange-400 p-6 text-center">
                    <p class="font-semibold text-gray-700">
                        No hay categorías registradas todavía.
                    </p>
                </div>
            </section>
        </main>
    </div>
</template>