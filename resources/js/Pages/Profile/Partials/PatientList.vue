<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  patients: Array
});
</script>

<template>
  <AuthenticatedLayout>
    <template #default>
      <div>
        <h1 class="text-2xl font-bold mb-4">Patients</h1>
        <table class="table-auto w-full border-collapse border border-gray-300">
          <thead>
            <tr>
              <th class="border p-2">First Name</th>
              <th class="border p-2">Last Name</th>
              <th class="border p-2">Email</th>
              <th class="border p-2">Phone</th>
              <th class="border p-2">Age</th>
              <th class="border p-2">Gender</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="patient in patients" :key="patient.id">
              <td class="border p-2">{{ patient.first_name }}</td>
              <td class="border p-2">{{ patient.last_name }}</td>
              <td class="border p-2">{{ patient.email }}</td>
              <td class="border p-2">{{ patient.phone }}</td>
              <td class="border p-2">{{ patient.age }}</td>
              <td class="border p-2">{{ patient.gender }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </AuthenticatedLayout>
</template>


  
 
  