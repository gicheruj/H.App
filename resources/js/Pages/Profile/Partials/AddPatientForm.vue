<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    age: '',
    gender: '',
    date_of_birth: '',
    address: '',
});

const submitForm = () => {
    form.post(route('patients.store'));
};
</script>

<template>
<AuthenticatedLayout>
  <section class="max-w-3xl mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg">
    <header class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Add New Patient</h2>
      <p class="mt-1 text-sm text-gray-600">Fill in the patient's information below.</p>
    </header>

    <form @submit.prevent="submitForm" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <InputLabel for="first_name" value="First Name" />
          <TextInput
            id="first_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.first_name"
            required
            autocomplete="given-name"
            aria-describedby="first_name_error"
          />
          <InputError id="first_name_error" class="mt-2" :message="form.errors.first_name" />
        </div>

        <div>
          <InputLabel for="last_name" value="Last Name" />
          <TextInput
            id="last_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.last_name"
            required
            autocomplete="family-name"
            aria-describedby="last_name_error"
          />
          <InputError id="last_name_error" class="mt-2" :message="form.errors.last_name" />
        </div>

        <div>
          <InputLabel for="email" value="Email (optional)" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            autocomplete="email"
            aria-describedby="email_error"
          />
          <InputError id="email_error" class="mt-2" :message="form.errors.email" />
        </div>

        <div>
          <InputLabel for="phone" value="Phone Number" />
          <TextInput
            id="phone"
            type="tel"
            class="mt-1 block w-full"
            v-model="form.phone"
            required
            autocomplete="tel"
            aria-describedby="phone_error"
          />
          <InputError id="phone_error" class="mt-2" :message="form.errors.phone" />
        </div>

        <div>
          <InputLabel for="age" value="Age" />
          <TextInput
            id="age"
            type="number"
            class="mt-1 block w-full"
            v-model="form.age"
            required
            min="0"
            max="150"
            aria-describedby="age_error"
          />
          <InputError id="age_error" class="mt-2" :message="form.errors.age" />
        </div>

        <div>
          <InputLabel for="gender" value="Gender" />
          <select
            id="gender"
            v-model="form.gender"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
            required
            aria-describedby="gender_error"
          >
            <option value="" disabled>Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <InputError id="gender_error" class="mt-2" :message="form.errors.gender" />
        </div>

        <div>
          <InputLabel for="date_of_birth" value="Date of Birth" />
          <TextInput
            id="date_of_birth"
            type="date"
            class="mt-1 block w-full"
            v-model="form.date_of_birth"
            required
            aria-describedby="date_of_birth_error"
          />
          <InputError id="date_of_birth_error" class="mt-2" :message="form.errors.date_of_birth" />
        </div>

        <div class="md:col-span-2">
          <InputLabel for="address" value="Address" />
          <TextInput
            id="address"
            type="text"
            class="mt-1 block w-full"
            v-model="form.address"
            required
            autocomplete="street-address"
            aria-describedby="address_error"
          />
          <InputError id="address_error" class="mt-2" :message="form.errors.address" />
        </div>
      </div>

      <div class="flex items-center justify-end gap-4 mt-6">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-green-600">Saved successfully!</p>
        </Transition>
      </div>
    </form>
  </section>
</AuthenticatedLayout>
</template>

