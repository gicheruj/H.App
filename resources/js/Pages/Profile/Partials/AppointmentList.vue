<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  appointments: Array
});

const selectedAppointment = ref(null);
const isEditing = ref(false);

const editForm = useForm({
  id: null,
  appointment_date: '',
  status: '',
  notes: ''
});

function openEditModal(appointment) {
  selectedAppointment.value = appointment;
  isEditing.value = true;

  // Pre-fill the form
  editForm.id = appointment.id;
  editForm.appointment_date = appointment.appointment_date.slice(0, 16); // for datetime-local
  editForm.status = appointment.status;
  editForm.notes = appointment.notes || '';
}

function closeModal() {
  isEditing.value = false;
  selectedAppointment.value = null;
}

function submitEdit() {
  editForm.patch(route('appointment.update', editForm.id), {
    onSuccess: () => {
      closeModal();
    }
  });
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleString();
}
</script>

<template>
  <AuthenticatedLayout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white rounded-2xl shadow-md p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Appointments</h1>

        <div class="overflow-x-auto">
          <table class="min-w-full table-auto border border-gray-200 text-sm text-gray-700">
            <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
              <tr>
                <th class="px-6 py-3 border-b">ID</th>
                <th class="px-6 py-3 border-b">Patient ID</th>
                <th class="px-6 py-3 border-b">Doctor ID</th>
                <th class="px-6 py-3 border-b">Date</th>
                <th class="px-6 py-3 border-b">Status</th>
                <th class="px-6 py-3 border-b">Notes</th>
                <th class="px-6 py-3 border-b">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="appointment in appointments"
                :key="appointment.id"
                class="hover:bg-gray-50 transition"
              >
                <td class="px-6 py-4 border-b text-center font-medium text-gray-900">
                  {{ appointment.id }}
                </td>
                <td class="px-6 py-4 border-b text-center">{{ appointment.patient_id }}</td>
                <td class="px-6 py-4 border-b text-center">{{ appointment.doctor_id }}</td>
                <td class="px-6 py-4 border-b text-center">{{ formatDate(appointment.appointment_date) }}</td>
                <td class="px-6 py-4 border-b text-center capitalize">
                  <span
                    :class="{
                      'text-green-600 font-medium': appointment.status === 'completed',
                      'text-yellow-600 font-medium': appointment.status === 'pending',
                      'text-red-600 font-medium': appointment.status === 'cancelled'
                    }"
                  >
                    {{ appointment.status }}
                  </span>
                </td>
                <td class="px-6 py-4 border-b text-center">
                  {{ appointment.notes || '—' }}
                </td>
                <td class="px-6 py-4 border-b text-center">
                  <button
                    @click="openEditModal(appointment)"
                    class="text-indigo-600 hover:text-indigo-900 underline"
                  >
                    Edit
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Edit Modal -->
      <dialog v-if="isEditing" open class="rounded-xl shadow-xl p-6 w-full max-w-lg mx-auto mt-10 bg-white border border-gray-300">
        <h2 class="text-xl font-semibold mb-4">Edit Appointment #{{ editForm.id }}</h2>

        <form @submit.prevent="submitEdit" class="space-y-4">
          <div>
            <label for="appointment_date" class="block text-sm font-medium text-gray-700">Date & Time</label>
            <input
              type="datetime-local"
              id="appointment_date"
              v-model="editForm.appointment_date"
              required
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>

          <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select
              id="status"
              v-model="editForm.status"
              required
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            >
              <option value="pending">Pending</option>
              <option value="completed">Completed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

          <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea
              id="notes"
              v-model="editForm.notes"
              rows="3"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            ></textarea>
          </div>

          <div class="flex justify-end space-x-2">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="editForm.processing"
              class="px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700"
            >
              Save
            </button>
          </div>
        </form>
      </dialog>
    </section>
  </AuthenticatedLayout>
</template>


