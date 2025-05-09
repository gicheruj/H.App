<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Appointments</h1>
  
      <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="border px-4 py-2">Patient ID</th>
            <th class="border px-4 py-2">Doctor ID</th>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="appointment in appointments" :key="appointment.id">
            <td class="border px-4 py-2">{{ appointment.patient_id }}</td>
            <td class="border px-4 py-2">{{ appointment.doctor_id }}</td>
            <td class="border px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>
            <td class="border px-4 py-2 capitalize">{{ appointment.status }}</td>
            <td class="border px-4 py-2">{{ appointment.notes || '-' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  defineProps({
    appointments: Array
  });
  
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString();
  }
  </script>
  