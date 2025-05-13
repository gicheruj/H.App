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
    Patient_Name: '',
    diagnosis: '',
    notes: '',
});

const submitForm = () => {
    form.post(route('diagnosis.store'));
};
</script>

<template>
    <AuthenticatedLayout>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Add New Diagnosis
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Fill in the details of the diagnosis.
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
                <InputLabel for="Patient_Name" value="Patient Name" />
                <TextInput
                    id="Patient_Name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.Patient_Name"
                    required
                    aria-describedby="Patient_Name_error"
                />
                <InputError id="Patient_Name_error" class="mt-2" :message="form.errors.Patient_Name" />
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
                <InputLabel for="Prescribed_medication" value="Prescribed Medication" />
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
                <InputLabel for="notes" value="Notes (optional)" />
                <TextInput
                    id="notes"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.notes"
                    aria-describedby="notes_error"
                />
                <InputError id="notes_error" class="mt-2" :message="form.errors.notes" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save Diagnosis</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</AuthenticatedLayout>
</template>
