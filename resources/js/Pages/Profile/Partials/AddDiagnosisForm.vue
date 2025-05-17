<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    patient_id: '',
    doctor_id: '',
    appointment_id: '',
    patient_name: '',
    diagnosis: '',
    prescribed_medication: '',
    notes: '',
});


const submitForm = () => {
    form.post(route('diagnosis.store'));
};

</script>

<template>
  <AuthenticatedLayout>
    <section class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-10">
      <header class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">🩺 Add New Diagnosis</h2>
        <p class="text-sm text-gray-500 mt-1">
          Fill in the patient's diagnosis details below. All fields are required unless stated otherwise.
        </p>
      </header>

      <form @submit.prevent="submitForm" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <InputLabel for="patient_id" value="Patient ID" />
            <TextInput
              id="patient_id"
              type="number"
              class="mt-1 block w-full"
              v-model="form.patient_id"
              required
              aria-describedby="patient_id_error"
            />
            <InputError id="patient_id_error" class="mt-2" :message="form.errors.patient_id" />
          </div>

          <div>
            <InputLabel for="doctor_id" value="Doctor ID" />
            <TextInput
              id="doctor_id"
              type="number"
              class="mt-1 block w-full"
              v-model="form.doctor_id"
              required
              aria-describedby="doctor_id_error"
            />
            <InputError id="doctor_id_error" class="mt-2" :message="form.errors.doctor_id" />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <InputLabel for="appointment_id" value="Appointment ID" />
            <TextInput
              id="appointment_id"
              type="number"
              class="mt-1 block w-full"
              v-model="form.appointment_id"
              required
              aria-describedby="appointment_id_error"
            />
            <InputError id="appointment_id_error" class="mt-2" :message="form.errors.appointment_id" />
          </div>

          <div>
            <InputLabel for="patient_name" value="patient name" />
            <TextInput
              id="patient_name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.patient_name"
              required
              aria-describedby="patient_name_error"
            />
            <InputError id="patient_name_error" class="mt-2" :message="form.errors.patient_name" />

          </div>
        </div>

        <div>
          <InputLabel for="diagnosis" value="Diagnosis" />
          <TextInput
            id="diagnosis"
            type="text"
            class="mt-1 block w-full"
            v-model="form.diagnosis"
            required
            aria-describedby="diagnosis_error"
          />
          <InputError id="diagnosis_error" class="mt-2" :message="form.errors.diagnosis" />
        </div>

        <div>
          <InputLabel for="prescribed_medication" value="prescribed medication" />
          <TextInput
            id="prescribed_medication"
            type="text"
            class="mt-1 block w-full"
            v-model="form.prescribed_medication"
            required
            aria-describedby="prescribed_medication_error"
          />
          <InputError id="prescribed_medication_error" class="mt-2" :message="form.errors.prescribed_medication" />
        </div>

        <div>
          <InputLabel for="notes" value="Notes (Optional)" />
          <textarea
            id="notes"
            rows="3"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            v-model="form.notes"
            aria-describedby="notes_error"
          ></textarea>
          <InputError id="notes_error" class="mt-2" :message="form.errors.notes" />
        </div>

        <div class="flex items-center gap-4">
          <PrimaryButton :disabled="form.processing">💾 Save Diagnosis</PrimaryButton>

          <Transition
            enter-active-class="transition ease-in-out duration-300"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out duration-300"
            leave-to-class="opacity-0"
          >
            <p v-if="form.recentlySuccessful" class="text-sm text-green-600 font-medium">
              ✅ Diagnosis successfully saved.
            </p>
          </Transition>
        </div>
      </form>
    </section>
  </AuthenticatedLayout>
</template>
