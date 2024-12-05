<template>
  <div>
    <Head title="Create Appointment" />

    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Appointment</h2>
          <button 
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded" 
            @click="openModal">
            Add Appointment
          </button>
        </div>
      </template>

      <div class="max-w-7xl px-4">
        <div class="bg-blue-200 px-10 py-4 mx-2 mt-6 rounded-md text-lg flex items-center mx-auto max-w-full ">
        <svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
            <path fill="currentColor"
                d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z">
            </path>
        </svg>
        <span class="text-blue-800 text-sm sm:text-base"> You Can Only Make Appointments Within Available Date and Hours. </span>
        </div>
      </div>

      <div class="bg-white my-8 mx-4 rounded shadow p-8">
        <!-- FullCalendar component with options -->
        <FullCalendar 
          class="w-full"
          :options="calendarOptions"
        />
      </div>

      <!-- Modal for Appointment Form -->
      <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-lg w-full">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Set Appointment Date</h3>
            <button 
              @click="closeModal" 
              class="bg-red-500 text-white font-bold w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600">
              &times;
            </button>
          </div>
          <div class="mb-4">
          <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
          <input
              type="datetime-local"
              id="appointment_date"
              v-model="form.appointment_date"
              required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
          />
          <p class="mt-2 text-sm text-gray-500">Selected Date: {{ formattedAppointmentDate }}</p>
      </div>

        <!-- <div class="mb-4 flex justify-center">
            <div class="text-center">
                <label class="block text-sm font-medium text-gray-700">Start Time</label>
                <p class="mt-1 text-gray-800">{{ form.start_time }}</p>
            </div>
            
            <div class="mx-6 text-center">
                <label class="block text-sm font-medium text-gray-700">End Time</label>
                <p class="mt-1 text-gray-800">{{ form.end_time }}</p>
            </div>
        </div> -->

          <div class="flex justify-center items-center">
            <button
              type="submit"
              class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
              @click="handleSubmit"
            >
              Create Appointment
            </button>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
import axios from 'axios';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

const page = usePage();
const userId = page.props.userId;

const props = defineProps({
  availabilities: {
    type: Array,
    required: true,
  },
});

const form = ref({
  patient_id: userId,
  dentist_id: '2',
  appointment_date: '',
  status: 'pending',
});

const isModalOpen = ref(false);
const openModal = () => {
  isModalOpen.value = true;
};
const closeModal = () => {
  isModalOpen.value = false;
};

const handleDateClick = (info) => {
  form.value.appointment_date = info.dateStr;
  openModal();
};

// Format time for display
const formatTime = (time) => {
  const date = new Date(time);
  const hours = date.getHours();
  const minutes = date.getMinutes();
  const ampm = hours >= 12 ? 'PM' : 'AM';
  const formattedHour = hours % 12 || 12;
  return `${formattedHour}:${minutes.toString().padStart(2, '0')} ${ampm}`;
};

// Format the date and time for submission (e.g., '2024-12-06 14:30:00')
const formattedAppointmentDate = computed(() => {
  if (!form.value.appointment_date) return '';

  const date = new Date(form.value.appointment_date);
  const options = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true,
  };

  return date.toLocaleString('en-US', options);
});

// Calendar options for the FullCalendar component
const calendarOptions = {
  initialView: 'dayGridMonth',
  plugins: [dayGridPlugin, interactionPlugin],
  events: props.availabilities.map((availability) => ({
    id: availability.id,
    start: `${availability.date}T${availability.start_time}`,
    end: `${availability.date}T${availability.end_time}`,
    backgroundColor: '#28a745',
    borderColor: '#28a745',
  })),
  dateClick: handleDateClick,
  eventContent: (arg) => {
    const startTime = formatTime(arg.event.start);
    const endTime = formatTime(arg.event.end);

    return {
      html: `
        <div class="fc-event-content">
          <div class="fc-event-time">${startTime}</div>
          <div class="fc-event-title">${endTime}</div>
          <div class="active-indicator" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #28a745; margin-left: 5px;"></div>
        </div>
      `,
    };
  },
};

onMounted(() => {
  if (props.errors.appointment_date) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: props.errors.appointment_date,
      confirmButtonText: 'OK',
    });
  }
});

// Handle form submission
const handleSubmit = async () => {
  try {
    // Convert the appointment date to Manila timezone
    const appointmentDate = new Date(form.value.appointment_date);
    const manilaDate = new Date(appointmentDate.toLocaleString("en-US", { timeZone: "Asia/Manila" }));
    
    // Format the date to match the backend format
    const formattedDate = manilaDate.toISOString().replace('T', ' ').slice(0, 19);

    const formData = {
      ...form.value,
      appointment_date: formattedDate,  // Send the converted date to the backend
    };

    // Create the appointment
    router.post(route('appointments.store'), formData, {
      onSuccess: (page) => {
        const successMessage = page?.props?.flash?.success || 'The appointment has been created successfully.';
        Swal.fire({
          icon: 'success',
          title: 'Appointment Created',
          text: successMessage,
          confirmButtonText: 'OK',
        }).then(() => {
          router.visit(route('appointments.my-appointments'));
        });
        form.value = {
          patient_id: userId,
          dentist_id: '2',
          appointment_date: '',
          status: 'pending',
        };
        closeModal();
      },
      onError: (errors) => {
        const errorMessage = Object.values(errors).flat().join('\n');
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: errorMessage || 'There was a problem creating the appointment.',
          confirmButtonText: 'Try Again',
        });
      },
    });
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'There was an unexpected error creating the appointment.',
      confirmButtonText: 'Try Again',
    });
  }
};

</script>


<style scoped>
.fixed {
  position: fixed;
}

.inset-0 {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.fc-event-content {
  display: flex;
  align-items: center;
}

.fc-event-time,
.fc-event-title {
  font-size: 1rem; /* Base font size */
  line-height: 1.2; /* Line height for better spacing */
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .fc-event-time,
  .fc-event-title {
    font-size: 0.875rem; /* Smaller font size for mobile devices */
  }
}

@media (min-width: 641px) and (max-width: 1024px) {
  .fc-event-time,
  .fc-event-title {
    font-size: 1rem; /* Medium font size for tablets */
  }
}

@media (min-width: 1025px) {
  .fc-event-time,
  .fc-event-title {
    font-size: 1.125rem; /* Larger font size for desktops */
  }
}

/* Active indicator styles */
.active-indicator {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: #28a745; /* Green color for the indicator */
  margin-left: 5px;
}
</style>
