<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  prescriptions: Array
});
</script>

<template>
  <AuthenticatedLayout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white shadow-md rounded-2xl p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">
          Prescriptions
        </h1>

        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-gray-700 border border-gray-200">
            <thead class="bg-green-50 text-gray-700 uppercase text-xs tracking-wider">
              <tr>
                <th class="px-6 py-3 border-b text-left">Medication Name</th>
                <th class="px-6 py-3 border-b text-left">Dosage</th>
                <th class="px-6 py-3 border-b text-left">Duration</th>
                <th class="px-6 py-3 border-b text-left">Instructions</th>
                <th class="px-6 py-3 border-b text-left">Diagnosis ID</th>
                <th class="px-6 py-3 border-b text-left">Doctor ID</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="prescription in prescriptions"
                :key="prescription.id"
                class="hover:bg-gray-50 transition"
              >
                <td class="px-6 py-4 border-b">{{ prescription.medication_name }}</td>
                <td class="px-6 py-4 border-b">{{ prescription.dosage }}</td>
                <td class="px-6 py-4 border-b">{{ prescription.duration }}</td>
                <td class="px-6 py-4 border-b">{{ prescription.instructions }}</td>
                <td class="px-6 py-4 border-b">{{ prescription.diagnosis_id }}</td>
                <td class="px-6 py-4 border-b">{{ prescription.doctor_id }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

  
  