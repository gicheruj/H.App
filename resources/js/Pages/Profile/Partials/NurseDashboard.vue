<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Nurse Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Nurse Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-green-700">Nurse Dashboard</h1>
                        <p class="mt-4 text-gray-600">
                            Welcome, Nurse! You have access to patient records.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <!-- <AddPatientForm/> -->
</template>
