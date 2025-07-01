<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const customer = { id: 1, name: 'Budi', phone: '08123456789' };
const histories = [
    { id: 1, date: '2024-06-01', style: 'Undercut', note: 'Rapi', photo: '', is_favorite: false },
    { id: 2, date: '2024-05-10', style: 'Pompadour', note: 'Bagus', photo: '', is_favorite: true },
];
</script>
<template>
    <Head title="Detail Pelanggan" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Detail Pelanggan</h2>
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-3xl bg-white rounded shadow p-6 mb-6">
                <div class="mb-2 font-bold">{{ customer.name }}</div>
                <div class="mb-4 text-gray-600">{{ customer.phone }}</div>
                <h3 class="font-semibold mb-2">Riwayat Potong</h3>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2">Tanggal</th>
                            <th class="text-left py-2">Gaya</th>
                            <th class="text-left py-2">Catatan</th>
                            <th class="text-left py-2">Favorit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="h in histories" :key="h.id">
                            <td class="py-2">{{ h.date }}</td>
                            <td class="py-2">{{ h.style }}</td>
                            <td class="py-2">{{ h.note }}</td>
                            <td class="py-2">
                                <span v-if="h.is_favorite" class="text-yellow-500">★</span>
                                <span v-else class="text-gray-400">☆</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 