<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  diagnoses: Array
});
</script>

<template>
  <AuthenticatedLayout>
  <section class="max-w-7xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-10">
    <header class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">📝 All Diagnoses</h2>
      <p class="text-sm text-gray-500 mt-1">
        Below is a list of all recorded diagnoses.
      </p>
    </header>

    <div class="overflow-x-auto">
      <table class="min-w-full text-left text-sm text-gray-600 border border-gray-200">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
          <tr>
            <th class="py-3 px-4 border">ID</th>
            <th class="py-3 px-4 border">Patient ID</th>
            <th class="py-3 px-4 border">Doctor ID</th>
            <th class="py-3 px-4 border">Appointment ID</th>
            <th class="py-3 px-4 border">Patient Name</th>
            <th class="py-3 px-4 border">Diagnosis</th>
            <th class="py-3 px-4 border">Prescribed Medication</th>
            <th class="py-3 px-4 border">Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="diagnosis in diagnoses" :key="diagnosis.id" class="hover:bg-gray-50">
            <td class="py-2 px-4 border">{{ diagnosis.id }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.patient_id }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.doctor_id }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.appointment_id }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.patient_name }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.diagnosis }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.prescribed_medication }}</td>
            <td class="py-2 px-4 border">{{ diagnosis.notes || '—' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</AuthenticatedLayout>
</template>
