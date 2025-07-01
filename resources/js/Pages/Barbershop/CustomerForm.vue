<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const name = ref('');
const phone = ref('');
</script>
<template>
    <Head title="Tambah Pelanggan" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Pelanggan</h2>
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-md bg-white rounded shadow p-6">
                <form>
                    <div class="mb-4">
                        <label class="block mb-1">Nama</label>
                        <input v-model="name" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">No. HP</label>
                        <input v-model="phone" class="w-full border rounded px-3 py-2" />
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 