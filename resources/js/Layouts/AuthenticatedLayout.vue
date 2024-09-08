<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="border-b border-gray-100 bg-green-500 fixed-nav">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('dashboard')">
                  <ApplicationLogo class="block h-auto w-12 fill-current text-gray-800" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="nav-link">
                  <b>Dashboard</b>
                </NavLink>
                <NavLink v-if="!isStudent" :href="route('appointments.index')" :active="route().current('appointments.index')" class="nav-link">
                  <b>Appointments</b>
                </NavLink>
                <NavLink v-if="isStudent" :href="route('appointments.create')" :active="route().current('appointments.create')" class="nav-link">
                  <b>Create Appointments</b>
                </NavLink>
                <NavLink :href="route('reports.index')" :active="route().current('reports.index')" class="nav-link">
                  <b>Reports</b>
                </NavLink>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ user.name }}
                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                      Log Out
                    </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Dropdown Menu for Mobile -->
            <div class="sm:hidden relative pt-3">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
              >
                <div><b>Menu</b></div>
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                    v-show="!showingNavigationDropdown"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    v-show="showingNavigationDropdown"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>

              <!-- Dropdown Content -->
              <div
                v-show="showingNavigationDropdown"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
              >
                <DropdownLink :href="route('dashboard')"> Dashboard </DropdownLink>
                <DropdownLink v-if="!isStudent" :href="route('appointments.index')"> Appointments </DropdownLink>
                <DropdownLink v-if="isStudent" :href="route('appointments.create')"> New Appointment </DropdownLink>
                <DropdownLink :href="route('reports.index')"> Reports </DropdownLink>
                <div class="border-t border-gray-100"></div>
                <div class="px-4 py-2">
                  <div class="font-medium text-gray-800">{{ user.name }}</div>
                  <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
                </div>
                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                  Log Out
                </DropdownLink>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header :class="headerClass" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

// Ref to manage the visibility of the dropdown
const showingNavigationDropdown = ref(false);

// Ref to manage the header class
const headerClass = ref('bg-white shadow pt-16');

// Function to update the header class based on screen size
const updateHeaderClass = () => {
  if (window.innerWidth >= 640) {
    headerClass.value = 'bg-white shadow';
  } else {
    headerClass.value = 'bg-white shadow pt-16';
  }
};

// Add event listener on mount
onMounted(() => {
  updateHeaderClass();
  window.addEventListener('resize', updateHeaderClass);
});

// Remove event listener before unmount
onBeforeUnmount(() => {
  window.removeEventListener('resize', updateHeaderClass);
});

// Use Inertia's usePage hook to access the page props
const { props } = usePage();
const user = props.auth.user;

// Computed property to check if the user is a student
const isStudent = computed(() => {
  return user.role === 'student';
});
</script>

<style scoped>
.nav-link {
  color: white;
}

/* Tailwind CSS classes for fixed navigation */
.fixed-nav {
  @apply sticky top-0 z-50;
}

/* Media query for mobile devices */
@media (max-width: 640px) {
  .fixed-nav {
    @apply fixed w-full;
  }
}
</style>