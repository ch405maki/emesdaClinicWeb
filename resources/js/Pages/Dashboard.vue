<template>
    <Head title="Dashboard" />
  
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
      </template>
  
      <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 space-y-6">
          <!-- Dashboard Cards -->
          <v-row align="center" justify="center" class="p-0" dense>
            <!-- Main Cards -->
            <v-col cols="12">
              <v-row>
                <!-- Card 1: Appointments -->
                <v-col cols="12" md="4">
                  <Link :href="route('reports.index')" class="block no-underline">
                    <v-card class="mx-auto" title="Appointments Request" subtitle="View and manage appointments">
                      <template v-slot:prepend>
                        <v-avatar size="40" color="green" class="gradient-border">
                          <v-icon color="white" icon="mdi-calendar-clock"></v-icon>
                        </v-avatar>
                      </template>
                        <v-card-text class="text-center">
                        <div v-if="request && request.length">
                          <p class="text-xl font-bold text-purple-900 mt-2">
                            Appointment Request: {{ request.length }}
                          </p>
                        </div>
                        <div v-else>
                          No Appointment Request at the moment
                        </div>
                        <div class="flex justify-center sm:justify-start mb-6 mt-6">
                        <div v-if="role == 'dentist' || role =='staff'">
                          <a :href="route('appointments.manage')" class="text-slate-800 font-medium text-base border border-green-800 hover:bg-violet-800 hover:text-white rounded-xl px-4 py-2 transition-colors duration-300">
                            Manage
                          </a>
                        </div>
                        <div v-else>
                          <a :href="route('appointments.my-appointments')" class="text-slate-800 font-medium text-base border border-green-800 hover:bg-green-800 hover:text-white rounded-xl px-4 py-2 transition-colors duration-300">
                            View
                          </a>
                        </div>
                        </div>
                      </v-card-text>
                    </v-card>
                  </Link>
                </v-col>
                <!-- Cards of upcoming appointments -->
                <v-col cols="12" md="8">
                  <v-card class="mx-auto" title="Upcoming Appointments" subtitle="Details of the upcoming appointments">
                    <template v-slot:prepend>
                      <v-avatar size="40" color="green" class="gradient-border">
                        <v-icon color="white" icon="mdi-calendar-clock"></v-icon>
                      </v-avatar>
                    </template>
                    <v-card-text>
                      <div>
                        <div class="overflow-x-auto">
                          <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                              <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                              </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                              <tr
                                v-for="appointment in appointments"
                                :key="appointment.id"
                                class="border-b border-gray-200 hover:bg-gray-100"
                              >
                                <!-- Date -->
                                <td class="px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>
                                <!-- Time -->
                                <td class="px-4 py-2">{{ formatTime(appointment.appointment_date) }}</td>
                                <!-- Actions -->
                                <td class="px-4 py-2 text-center">
                                  <button
                                    @click="handleAction(appointment.id)"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                                  >
                                    Show
                                  </button>
                                </td>
                              </tr>
                              <tr v-if="appointments.length === 0">
                                <td colspan="3" class="px-4 py-2 text-center">No upcoming appointments found.</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>

                <div v-if="role === 'dentist' || role === 'staff'" class="mx-4 md:mx-10 my-6">
                  <!-- Table -->
                  <div class="shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center bg-white p-4 justify-between">
                      <h2 class="text-xl font-bold text-gray-800">Recent Records</h2>
                  </div>
                      <table class="w-full table-fixed">
                          <thead>
                              <tr class="bg-gray-100">
                                  <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Name</th>
                                  <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date</th>
                                  <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Time</th>
                                  <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status</th>
                              </tr>
                          </thead>
                          <tbody class="bg-white">
                              <tr v-for="report in reports" :key="report.id">
                                  <td class="py-4 px-6 border-b border-gray-200">{{ report.patient.name }}</td>
                                  <td class="py-4 px-6 border-b border-gray-200">{{ formatDate(report.appointment_date) }}</td>
                                  <td class="py-4 px-6 border-b border-gray-200">{{ formatTime(report.appointment_date) }}</td>
                                  <td class="py-4 px-6 border-b border-gray-200">
                                      <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs">Completed</span>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                      <div class="shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center bg-white p-4 justify-center">
                      <a :href="route('reports.index')"
                        class="bg-green-500 text-white font-bold py-2 px-4 rounded-xl 
                                hover:bg-green-600">
                        Show All Records
                      </a>
                    </div>
                  </div>
                  </div>
              </div>

                <!-- End of upcoming appointments -->
              </v-row>
            </v-col>
          </v-row>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { usePage, router } from '@inertiajs/vue3';
  import '@mdi/font/css/materialdesignicons.min.css';
  
  const props = defineProps({
  appointments: {
    type: Object,
    required: true
  },
  request: {
    type: Object,
    required: true
  },
  role: {
    type: Object,
    required: true
  },
  reports: {
    type: Object,
    required: true
  },
});

  // Initialize appointments and search query

  const searchQuery = ref('');
  
  // Get the appointments data from the page props
  
  // Detect screen size to determine column visibility
  const isSmScreen = window.innerWidth < 640; // Adjust breakpoint as per your design
  

  
  // Computed property to filter appointments based on search query
  const filteredAppointments = computed(() => {
    if (!searchQuery.value) {
      return appointments.value;
    }
    return appointments.value.filter((appointment) => {
      return (
        appointment.diagnostic?.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        appointment.patient?.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        formatDate(appointment.appointment_date).toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });
  });
  
  // Define method to handle actions
  const handleAction = (appointmentId) => {
    // Use the Inertia router to navigate to the show page
    router.get(route('appointments.show', appointmentId));
  };
  
  // Define method to format date
  const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = { month: 'long', day: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
  };
  
  // Define method to format time
  const formatTime = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  };
  </script>
  
  <style scoped>
  /* Custom styles for the gradient border */
  .gradient-border {
    background: linear-gradient(45deg, #8e44ad, #5b2c6f);
    border-radius: 50%;
    padding: 4px; /* Adjust padding as needed */
  }

  .gradient-border > .v-avatar__content {
    padding: 8px; /* Adjust padding for icon */
  }
  </style>
  