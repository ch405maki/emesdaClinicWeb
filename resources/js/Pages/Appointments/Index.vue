<template>
  <div>
    <Head title="Appointments" />

    <AuthenticatedLayout>
      <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
      return '#EF4444'; // Tailwind red-500
    case 'completed':
      return '#6B21A8'; // Tailwind purple-600
    case 'confirmed':
      return '#10B981'; // Tailwind green-500
    case 'pending':
      return '#FBBF24'; // Tailwind yellow-400
    default:
      return '#9CA3AF'; // Tailwind gray-400 for undefined status
  }
}

// Set up calendar options
const calendarOptions = {
  initialView: 'dayGridMonth',
  plugins: [dayGridPlugin, interactionPlugin],
  events: props.appointments.map(appointment => ({
    id: appointment.id,
    title: appointment.status,
    start: appointment.appointment_date,
    backgroundColor: getStatusColor(appointment.status), // Set the background color based on status
    borderColor: getStatusColor(appointment.status) // Matching border color
  })),
  eventClick: handleEventClick, // Add event click handler
  eventDidMount: (info) => {
    // Change the cursor to pointer on hover
    info.el.style.cursor = 'pointer';
  }
};
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
