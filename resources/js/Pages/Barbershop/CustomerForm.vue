<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const name = ref('');
const phone = ref('');
const photo = ref(null);
const error = ref('');

const submit = async (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('name', name.value);
    formData.append('phone', phone.value);
    if (photo.value) formData.append('photo', photo.value);
    try {
        await fetch('/api/customers', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
            credentials: 'include',
        });
        // redirect or reset form
        name.value = '';
        phone.value = '';
        photo.value = null;
        error.value = '';
        alert('Pelanggan berhasil ditambah!');
    } catch (err) {
        error.value = 'Gagal menambah pelanggan';
    }
};
</script>
<template>
    <Head title="Tambah Pelanggan" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Pelanggan</h2>
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-md bg-white rounded shadow p-6">
                <form @submit="submit">
                    <div class="mb-4">
                        <label class="block mb-1">Nama</label>
                        <input v-model="name" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">No. HP</label>
                        <input v-model="phone" class="w-full border rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Foto (opsional)</label>
                        <input type="file" @change="e => photo.value = e.target.files[0]" />
                    </div>
                    <div v-if="error" class="text-red-500 mb-2">{{ error }}</div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 