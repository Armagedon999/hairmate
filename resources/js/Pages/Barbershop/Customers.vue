<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const customers = [
    { id: 1, name: 'Budi', phone: '08123456789' },
    { id: 2, name: 'Andi', phone: '08129876543' },
];
</script>
<template>
    <Head title="Daftar Pelanggan" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Daftar Pelanggan</h2>
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-3xl bg-white rounded shadow p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2">Nama</th>
                            <th class="text-left py-2">No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="c in customers" :key="c.id">
                            <td class="py-2">{{ c.name }}</td>
                            <td class="py-2">{{ c.phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 