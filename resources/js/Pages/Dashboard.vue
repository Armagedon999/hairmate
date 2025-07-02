<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
const isBarbershop = computed(() => user.value?.role === 'barbershop');
const isPelanggan = computed(() => user.value?.role === 'pelanggan');
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <template v-if="isBarbershop">
                            <div>
                                <h3 class="font-bold mb-2">Menu Barbershop</h3>
                                <ul class="list-disc ml-6">
                                    <li><a href="#" class="text-blue-600">Daftar Pelanggan</a></li>
                                    <li><a href="#" class="text-blue-600">Tambah Pelanggan</a></li>
                                </ul>
                            </div>
                        </template>
                        <template v-else-if="isPelanggan">
                            <div>
                                <h3 class="font-bold mb-2">Menu Pelanggan</h3>
                                <ul class="list-disc ml-6">
                                    <li><a href="#" class="text-blue-600">Riwayat Potong Saya</a></li>
                                    <li><a href="#" class="text-blue-600">Gaya Favorit</a></li>
                                </ul>
                            </div>
                        </template>
                        <template v-else>
                            <div>You're logged in!</div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
