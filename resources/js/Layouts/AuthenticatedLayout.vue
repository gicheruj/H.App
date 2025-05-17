<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const { user } = usePage().props.auth;

</script>


<template>
    <div class="min-h-screen bg-gray-100 font-sans antialiased">
      <!-- Navbar -->
      <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <!-- Left: Logo + NavLinks -->
            <div class="flex items-center space-x-8">
              <!-- Logo -->
              <img
                src="/images/Logo.png"
                alt="ImariQa Hospital Logo"
                class="w-12 h-12 rounded-full object-cover"
              />

            
              <!-- NavLinks based on role -->
              <div class="hidden sm:flex space-x-4 text-sm font-medium text-gray-600">
                <template v-if="user.role === 'nurse'">
                  <NavLink :href="route('nurse.dashboard')" :active="route().current('nurse.dashboard')">
                    Dashboard
                  </NavLink>
                  <NavLink :href="route('patients.create')" :active="route().current('patients.create')">
                    Add New Patient
                  </NavLink>
                  <NavLink :href="route('appointment.create')" :active="route().current('appointment.create')">
                    Schedule Appointment
                  </NavLink>
                  <NavLink :href="route('patients.index')" :active="route().current('patients.index')">
                    View Patients
                  </NavLink>
                </template>
  
                <template v-if="user.role === 'doctor'">
                  <NavLink :href="route('doctor.dashboard')" :active="route().current('doctor.dashboard')">
                    Dashboard
                  </NavLink>
                  <NavLink :href="route('diagnosis.create')" :active="route().current('diagnosis.create')">
                    Diagnosis
                  </NavLink>
                  <NavLink :href="route('appointments.index')" :active="route().current('appointments.index')">
                    View Appointments
                  </NavLink>
                </template>
  
                <template v-if="user.role === 'pharmacist'">
                  <NavLink :href="route('pharmacist.dashboard')" :active="route().current('pharmacist.dashboard')">
                    Dashboard
                  </NavLink>
                  <NavLink :href="route('prescription.create')" :active="route().current('prescription.create')">
                    Prescriptions
                  </NavLink>
                  <NavLink :href="route('diagnosis.index')" :active="route().current('diagnosis.index')">
                    View Diagnosis
                  </NavLink>
                </template>
              </div>
            </div>
  
            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex sm:items-center">
              <div class="relative ml-4">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <button
                      type="button"
                      class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring focus:ring-indigo-300"
                    >
                      {{ $page.props.auth.user.name }}
                      <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                           viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06 0L10 10.94l3.71-3.73a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                              clip-rule="evenodd" />
                      </svg>
                    </button>
                  </template>
  
                  <template #content>
                    <DropdownLink :href="route('profile.edit')">
                      Profile
                    </DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                      Log Out
                    </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>
          </div>
        </div>
      </nav>
  
      <!-- Page Content -->
      <main class="py-10 px-4 sm:px-6 lg:px-8">
        <slot />
      </main>
    </div>
  </template>
  