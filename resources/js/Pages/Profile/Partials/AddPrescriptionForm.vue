<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    diagnosis_id: '',
    doctor_id: '',
    medication_name: '',
    dosage: '',
    duration: '',
    instructions: '',
});

const submitForm = () => {
    form.post(route('prescription.store'));
};
</script>

<template>
    <AuthenticatedLayout>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Add New Prescription
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Fill in the details of the prescription.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <div>
                <InputLabel for="diagnosis_id" value="Diagnosis ID" />
                <TextInput
                    id="diagnosis_id"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.diagnosis_id"
                    required
                    aria-describedby="diagnosis_id_error"
                />
                <InputError id="diagnosis_id_error" class="mt-2" :message="form.errors.diagnosis_id" />
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
                <InputLabel for="medication_name" value="Medication Name" />
                <TextInput
                    id="medication_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.medication_name"
                    required
                    aria-describedby="medication_name_error"
                />
                <InputError id="medication_name_error" class="mt-2" :message="form.errors.medication_name" />
            </div>

            <div>
                <InputLabel for="dosage" value="Dosage" />
                <TextInput
                    id="dosage"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.dosage"
                    required
                    aria-describedby="dosage_error"
                />
                <InputError id="dosage_error" class="mt-2" :message="form.errors.dosage" />
            </div>

            <div>
                <InputLabel for="duration" value="Duration" />
                <TextInput
                    id="duration"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.duration"
                    required
                    aria-describedby="duration_error"
                />
                <InputError id="duration_error" class="mt-2" :message="form.errors.duration" />
            </div>

            <div>
                <InputLabel for="instructions" value="Instructions (optional)" />
                <TextInput
                    id="instructions"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.instructions"
                    aria-describedby="instructions_error"
                />
                <InputError id="instructions_error" class="mt-2" :message="form.errors.instructions" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save Prescription</PrimaryButton>

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
