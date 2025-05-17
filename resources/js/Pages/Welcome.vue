<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Head title="Welcome" />

  <div class="flex flex-col items-center justify-center min-h-screen bg-white px-6 text-center">
    <!-- Logo -->
    <img
      src="/images/Logo.png"
      alt="ImariQa Hospital Logo"
      class="w-32 h-auto mb-6"
    />

    <!-- App Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-2">
      Welcome to ImariQa Hospital System
    </h1>
    <p class="text-lg text-gray-600 max-w-md mb-10">
      A comprehensive hospital management platform tailored for nurses, doctors, and pharmacists to efficiently manage patients, appointments, diagnoses, and prescriptions.
    </p>

    <!-- Navigation -->
    <div class="flex flex-col sm:flex-row gap-4">
      <template v-if="canLogin">
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="rounded-lg bg-blue-600 text-white px-5 py-2 text-sm font-medium hover:bg-blue-700 transition"
        >
          Go to Dashboard
        </Link>

        <template v-else>
          <Link
            :href="route('login')"
            class="rounded-lg bg-green-600 text-white px-5 py-2 text-sm font-medium hover:bg-green-700 transition"
          >
            Log In
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="rounded-lg bg-gray-200 text-gray-800 px-5 py-2 text-sm font-medium hover:bg-gray-300 transition"
          >
            Register
          </Link>
        </template>
      </template>
    </div>
  </div>
</template>

  
