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
    appointment_date: '',
    status: 'pending',
    notes: '',
});

const submitForm = () => {
    form.post(route('appointment.store'));
};
</script>

<template>
    <AuthenticatedLayout>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Schedule Appointment
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Enter the appointment details below.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
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

            <div>
                <InputLabel for="appointment_date" value="Appointment Date & Time" />
                <TextInput
                    id="appointment_date"
                    type="datetime-local"
                    class="mt-1 block w-full"
                    v-model="form.appointment_date"
                    required
                    aria-describedby="appointment_date_error"
                />
                <InputError id="appointment_date_error" class="mt-2" :message="form.errors.appointment_date" />
            </div>

            <div>
                <InputLabel for="status" value="Status" />
                <select
                    id="status"
                    v-model="form.status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                    aria-describedby="status_error"
                >
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <InputError id="status_error" class="mt-2" :message="form.errors.status" />
            </div>

            <div>
                <InputLabel for="notes" value="Notes (optional)" />
                <textarea
                    id="notes"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    v-model="form.notes"
                    rows="3"
                    aria-describedby="notes_error"
                ></textarea>
                <InputError id="notes_error" class="mt-2" :message="form.errors.notes" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Schedule</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        Appointment scheduled.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
    </AuthenticatedLayout>
</template>
