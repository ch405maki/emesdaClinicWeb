<template>
  <div>
    <Head title="Appointments" />

    <AuthenticatedLayout>
      <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="flex items-center gap-4 mb-2">

            <h1 class="flex items-center">
              <svg class="w-6 h-6 text-[#10B981]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
              </svg>
              <span class="ml-2">Confirmed</span>
            </h1>
            
            <h1 class="flex items-center">
              <svg class="w-6 h-6 text-[#FBBF24]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
              </svg>
              <span class="ml-2">Pending</span>
            </h1>

            <h1 class="flex items-center">
              <svg class="w-6 h-6 text-[#EF4444]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm5.757-1a1 1 0 1 0 0 2h8.486a1 1 0 1 0 0-2H7.757Z" clip-rule="evenodd"/>
              </svg>
              <span class="ml-2">Canceled</span>
            </h1>
          </div>
          <!-- FullCalendar component with Tailwind CSS classes -->
          <FullCalendar 
            class="w-full"
            :options="calendarOptions" 
          />
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { Head, router } from '@inertiajs/vue3'; // Import router from Inertia
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

// Define the props passed to the component
const props = defineProps({
  appointments: {
    type: Array,
    required: true
  }
});

// Function to handle event clicks
function handleEventClick(info) {
  // Redirect to the detailed appointment page with the event ID
  router.get(`/appointments/${info.event.id}`);
}

// Function to determine the background color based on status
function getStatusColor(status) {
  switch (status.toLowerCase()) {
    case 'canceled':
      return '#EF4444';
    case 'completed':
      return '#6B21A8';
    case 'confirmed':
      return '#10B981';
    case 'pending':
      return '#FBBF24'; 
    default:
      return '#9CA3AF'; 
  }
}

const calendarOptions = {
  initialView: 'dayGridMonth',
  plugins: [dayGridPlugin, interactionPlugin],
  events: props.appointments.map(appointment => ({
  id: appointment.id,
  title: appointment.patient.name, // Display only the patient's name
  start: appointment.appointment_date,
  allDay: true, // Prevents time from being displayed
  backgroundColor: getStatusColor(appointment.status),
  borderColor: getStatusColor(appointment.status)
})),


  eventClick: handleEventClick,

  eventDidMount: (info) => {
    // Enable text wrapping for long names
    info.el.style.whiteSpace = "normal"; // Allow text to wrap
    info.el.style.overflowWrap = "break-word"; // Ensure long words wrap
    info.el.style.wordBreak = "break-word"; // Alternative for better support
    info.el.style.padding = "5px"; // Add padding for better readability
  }
};
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
