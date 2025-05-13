<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  prescriptions: Array
});
</script>

<template>
    <AuthenticatedLayout>
        <template #default>
            <div>
            <h1 class="text-2xl font-bold mb-4">Prescriptions</h1>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr>
                    <th class="border p-2">Medication Name</th>
                    <th class="border p-2">Dosage</th>
                    <th class="border p-2">Duration</th>
                    <th class="border p-2">Instructions</th>
                    <th class="border p-2">Diagnosis ID</th>
                    <th class="border p-2">Doctor ID</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="prescription in prescriptions" :key="prescription.id">
                    <td class="border p-2">{{ prescription.medication_name }}</td>
                    <td class="border p-2">{{ prescription.dosage }}</td>
                    <td class="border p-2">{{ prescription.duration }}</td>
                    <td class="border p-2">{{ prescription.instructions }}</td>
                    <td class="border p-2">{{ prescription.diagnosis_id }}</td>
                    <td class="border p-2">{{ prescription.doctor_id }}</td>
                </tr>
                </tbody>
            </table>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
  
  