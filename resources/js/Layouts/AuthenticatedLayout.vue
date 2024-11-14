<template>
  <div class=" min-h-screen bg-gray-100">
    <div class="h-full">
      <div class="min-h-full">
        <!-- When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars -->
        <header class="bg-white shadow-sm lg:static lg:overflow-y-visible" :class="{ 'fixed inset-0 z-40 overflow-y-auto': isMenuOpen }">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
              <!-- Logo Section -->
              <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                <div class="flex flex-shrink-0 items-center">
                  <div class="p-2.5 mt-1 flex items-center">
                  <Link class="flex items-center">
                    <img src="/images/dentallogo.png" alt="Image Logo" class="max-w-full h-full max-h-8 mr-2 transition-transform duration-300 transform hover:scale-105">
                  </Link>
                  <div>
                    <div class="text-invicta uppercase font-bold text-gray-700  text-sm tracking-wide leading-tight">E M E S &nbsp; D A &nbsp;  K A L I N G A</div>
                    <div class="text-invicta uppercase font-bold text-gray-700 text-sm tracking-wide leading-tight">D E N T A L &nbsp; C L I N I C</div>
                  </div>
                </div>
                </div>
              </div>
              <!-- Search Section -->
              <div class="min-w-0 flex-1 md:px-8 lg:py-2 xl:col-span-6">
                <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                  
                </div>
              </div>

              <!-- Mobile Menu Button -->
              <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
                <button type="button" class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500" @click="toggleMenu">
                  <span class="sr-only">Open menu</span>
                  <svg class="h-6 w-6" v-if="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                  </svg>
                  <svg class="h-6 w-6" v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                </button>
              </div>

              <!-- Desktop Actions -->
              <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                <a v-if="user.role === 'dentist' || user.role === 'staff'" :href="route('appointments.manage')" class="ml-5 flex-shrink-0 relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                  <span class="sr-only">View notifications</span>
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                  </svg>
                  
                  <!-- Sidebar Length Notification -->
                  <span class="absolute top-0 mt-[1px] right-0 inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-red-800 bg-red-100 rounded-full transform translate-x-1/2 -translate-y-1/2">
                    {{ sidebar.length }}
                  </span>
                </a>
                <div class="relative ml-5 flex-shrink-0">
                  <button type="button" class="flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2" @click="toggleProfileMenu">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                  </button>
                  <!-- Profile dropdown -->
                  <div v-if="isProfileMenuOpen" @click.away="isProfileMenuOpen = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <a href="#" class="block py-2 px-4 text-sm text-gray-700">Hi, {{ user.name }}</a>
                    <a :href="route('profile.edit')" class="block py-2 px-4 text-sm text-gray-700">Your Profile</a> 
                    <a :href="route('logout')"  as="button" class="block py-2 px-4 text-sm text-gray-700">Sign out</a>
                  </div>
                </div>
                <p class="ml-2 text-invicta uppercase font-bold text-gray-700 text-sm tracking-wide leading-tight">Hi, {{ user.name }}</p>
              </div>
            </div>
          </div>

          <!-- Mobile Menu -->
          <nav v-if="isMenuOpen" class="lg:hidden" aria-label="Global" @click.away="isMenuOpen = false">
            <div v-if="user.role == 'patient'" class="mx-auto max-w-3xl space-y-1 px-2 pt-2 pb-3 sm:px-4">
              <a :href="route('dashboard')" class="bg-gray-100 text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Home</a>
              <a :href="route('appointments.create')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">New Appointment</a>
              <a :href="route('appointments.my-appointments')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">My Appointments</a>
              <a :href="route('reports.index')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">My Records</a>
            </div>
            <div v-if="user.role == 'staff'" class="mx-auto max-w-3xl space-y-1 px-2 pt-2 pb-3 sm:px-4">
              <a :href="route('dashboard')" class="bg-gray-100 text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Home</a>
              <a :href="route('appointments.staff')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">View Appointment(s)</a>
              <a :href="route('reports.index')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Patient Records</a>
            </div>
            <div v-if="user.role == 'dentist'" class="mx-auto max-w-3xl space-y-1 px-2 pt-2 pb-3 sm:px-4">
              <a :href="route('dashboard')" class="bg-gray-100 text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Home</a>
              <a :href="route('appointments.index')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Appointment(s)</a>
              <a :href="route('appointments.manage')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Manage</a>
              <a :href="route('reports.index')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Patient Records</a>
              <div class="border-t border-gray-200 pt-4">
              <div class="mx-auto max-w-3xl space-y-1">
                <a :href="route('dentist.availability')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Availability</a>
                <a :href="route('staff')"  class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Manage Staff</a>
              </div>
            </div>
            </div>
            <div class="border-t border-gray-200 pt-4">
              <div class="mx-auto max-w-3xl space-y-1 px-4">
                <a :href="route('profile.edit')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Profile</a>
                <a :href="route('logout')" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Sign out</a>
              </div>
            </div>
          </nav>
        </header>
        <div class="py-10">
        <div class="mx-auto max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-8 lg:px-8">
          <div class="hidden lg:col-span-3 lg:block xl:col-span-2 ">
            <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
              <div class="space-y-1 pb-8">
                
                  <a :href="route('dashboard')" class="text-gray-900 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" aria-current="page" x-state:on="Current" x-state:off="Default" x-state-description="Current: &quot;bg-gray-200 text-gray-900&quot;, Default: &quot;text-gray-700 hover:bg-gray-50&quot;">
                    <svg class="text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" x-description="Heroicon name: outline/home" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                    </svg>
                    <span class="truncate">Home</span>
                  </a>
                
                  <a v-if="user.role === 'dentist'" :href="route('appointments.index')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: 'bg-gray-200 text-gray-900', undefined: 'text-gray-700 hover:bg-gray-50'">
                    <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path d="M12 4.5c-3.172 0-5.75 2.578-5.75 5.75S8.828 16 12 16s5.75-2.578 5.75-5.75S15.172 4.5 12 4.5zM12 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <path d="M12 2.25a9.75 9.75 0 0 1 0 19.5m0-19.5a9.75 9.75 0 0 0 0 19.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    </svg>
                    <span class="truncate">Appointments</span>
                  </a>
                  
                  <a v-if="user.role === 'patient'" :href="route('appointments.create')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: &quot;bg-gray-200 text-gray-900&quot;, undefined: &quot;text-gray-700 hover:bg-gray-50&quot;">
                    <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path d="M12 4.5c-3.172 0-5.75 2.578-5.75 5.75S8.828 16 12 16s5.75-2.578 5.75-5.75S15.172 4.5 12 4.5zM12 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <path d="M12 2.25a9.75 9.75 0 0 1 0 19.5m0-19.5a9.75 9.75 0 0 0 0 19.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    </svg>
                    <span class="truncate">New Appointment</span>
                  </a>
                  <a v-if="user.role === 'patient'" :href="route('appointments.my-appointments')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: &quot;bg-gray-200 text-gray-900&quot;, undefined: &quot;text-gray-700 hover:bg-gray-50&quot;">
                    <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path d="M12 4.5c-3.172 0-5.75 2.578-5.75 5.75S8.828 16 12 16s5.75-2.578 5.75-5.75S15.172 4.5 12 4.5zM12 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <path d="M12 2.25a9.75 9.75 0 0 1 0 19.5m0-19.5a9.75 9.75 0 0 0 0 19.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    </svg>
                    <span class="truncate">My Appointments</span>
                  </a>
                  <a  v-if="user.role === 'dentist'" :href="route('appointments.manage')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: &quot;bg-gray-200 text-gray-900&quot;, undefined: &quot;text-gray-700 hover:bg-gray-50&quot;">
                      <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25c-2.1 0-3.75 1.65-3.75 3.75s1.65 3.75 3.75 3.75 3.75-1.65 3.75-3.75-1.65-3.75-3.75-3.75zM21 11.25h-1.477c-.45-1.72-1.48-3.23-2.827-4.227l.942-.942a.75.75 0 00-1.06-1.06l-.942.942a8.968 8.968 0 00-4.227-2.827V3a.75.75 0 00-1.5 0v1.477c-1.72.45-3.23 1.48-4.227 2.827l-.942-.942a.75.75 0 00-1.06 1.06l.942.942a8.968 8.968 0 00-2.827 4.227H3a.75.75 0 000 1.5h1.477c.45 1.72 1.48 3.23 2.827 4.227l-.942.942a.75.75 0 101.06 1.06l.942-.942a8.968 8.968 0 004.227 2.827V21a.75.75 0 001.5 0v-1.477a8.968 8.968 0 004.227-2.827l.942.942a.75.75 0 001.06-1.06l-.942-.942a8.968 8.968 0 002.827-4.227H21a.75.75 0 000-1.5z"></path>
                      </svg>
                      <span class="truncate">Manage</span> 
                  </a>

                  <a  v-if="user.role === 'staff'" :href="route('appointments.staff')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: &quot;bg-gray-200 text-gray-900&quot;, undefined: &quot;text-gray-700 hover:bg-gray-50&quot;">
                      <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25c-2.1 0-3.75 1.65-3.75 3.75s1.65 3.75 3.75 3.75 3.75-1.65 3.75-3.75-1.65-3.75-3.75-3.75zM21 11.25h-1.477c-.45-1.72-1.48-3.23-2.827-4.227l.942-.942a.75.75 0 00-1.06-1.06l-.942.942a8.968 8.968 0 00-4.227-2.827V3a.75.75 0 00-1.5 0v1.477c-1.72.45-3.23 1.48-4.227 2.827l-.942-.942a.75.75 0 00-1.06 1.06l.942.942a8.968 8.968 0 00-2.827 4.227H3a.75.75 0 000 1.5h1.477c.45 1.72 1.48 3.23 2.827 4.227l-.942.942a.75.75 0 101.06 1.06l.942-.942a8.968 8.968 0 004.227 2.827V21a.75.75 0 001.5 0v-1.477a8.968 8.968 0 004.227-2.827l.942.942a.75.75 0 001.06-1.06l-.942-.942a8.968 8.968 0 002.827-4.227H21a.75.75 0 000-1.5z"></path>
                      </svg>
                      <span class="truncate">View <br> Appointments</span> 
                  </a>
                  
                  <a :href="route('reports.index')" class="text-gray-700 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md" x-state-description="undefined: &quot;bg-gray-200 text-gray-900&quot;, undefined: &quot;text-gray-700 hover:bg-gray-50&quot;">
                    <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 2.25h9l3.75 3.75V20.25A1.5 1.5 0 0117.25 21.75H6.75A1.5 1.5 0 015.25 20.25V3.75A1.5 1.5 0 016.75 2.25zM14.25 2.25v4.5h4.5M8.25 11.25h7.5M8.25 15.75h7.5M8.25 7.5h1.5"></path>
                    </svg>
                    <span class="truncate">Patients Record</span>
                </a>
              </div>
              
              <div class="pt-10" v-if="user.role === 'dentist'">
                <p class="px-3 text-sm font-medium text-gray-500" id="communities-headline">Settings</p>
                <div class="mt-3 space-y-2" aria-labelledby="communities-headline">
                    <a :href="route('dentist.availability')" class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                      <span class="truncate">Availability</span>
                    </a>
                    <a :href="route('staff')" class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                      <span class="truncate">Manage Staff</span>
                    </a>
                </div>
              </div>
              <div class="pt-10">
                <p class="px-3 text-sm font-medium text-gray-500" id="communities-headline"></p>
                <div class="mt-3 space-y-2" aria-labelledby="communities-headline">
                  <a :href="route('profile.edit')" class="hover:bg-gray-50 text-gray-500 hover:text-gray-600 block rounded-md py-2 px-3 text-base font-medium">Profile</a>
                  <a :href="route('logout')" class="hover:bg-gray-50 block text-gray-500 hover:text-gray-600 rounded-md py-2 px-3 text-base font-medium">Sign out</a>
                </div>
              </div>
            </nav>
          </div>
          <main class="lg:col-span-9 xl:col-span-10">
            <header v-if="$slots.header" class="mx-4">
            <div class="max-w-7xl mx-auto py-6 px-4 mx-10 sm:px-6 lg:px-8 rounded-lg bg-white shadow">
            <slot name="header" />
            </div>
            </header>
            <div>
              <slot />
            </div>
        </main>
        </div>
      </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';  
import { Link } from '@inertiajs/vue3';

// State management using ref for menu visibility
const isMenuOpen = ref(false);
const isProfileMenuOpen = ref(false);

const logout = () => {
  Inertia.post(route('logout'));
};

// Methods to toggle the menus
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const toggleProfileMenu = () => {
  isProfileMenuOpen.value = !isProfileMenuOpen.value;
};

const sidebar = ref([]); // Store banners as an array

  const FetchSidebar = async () => {
    try {
      const response = await fetch('/sidebar');
      sidebar.value = await response.json(); // Fetch the data as an array
    } catch (error) {
      console.error('Error fetching sidebar:', error);
    }
  };

onMounted(FetchSidebar);

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