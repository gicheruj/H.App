<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  patients: Array
});
</script>

<template>
  <AuthenticatedLayout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white shadow-md rounded-2xl p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">
          Patients
        </h1>

        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-gray-700 border border-gray-200">
            <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
              <tr>
                <th class="px-6 py-3 border-b text-left">Patient ID</th>
                <th class="px-6 py-3 border-b text-left">First Name</th>
                <th class="px-6 py-3 border-b text-left">Last Name</th>
                <th class="px-6 py-3 border-b text-left">Email</th>
                <th class="px-6 py-3 border-b text-left">Phone</th>
                <th class="px-6 py-3 border-b text-left">Age</th>
                <th class="px-6 py-3 border-b text-left">Gender</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="patient in patients"
                :key="patient.id"
                class="hover:bg-gray-50 transition"
              >
                <td class="px-6 py-4 border-b font-medium text-gray-900">{{ patient.id }}</td>
                <td class="px-6 py-4 border-b">{{ patient.first_name }}</td>
                <td class="px-6 py-4 border-b">{{ patient.last_name }}</td>
                <td class="px-6 py-4 border-b">{{ patient.email }}</td>
                <td class="px-6 py-4 border-b">{{ patient.phone }}</td>
                <td class="px-6 py-4 border-b">{{ patient.age }}</td>
                <td class="px-6 py-4 border-b capitalize">{{ patient.gender }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

  
 
  