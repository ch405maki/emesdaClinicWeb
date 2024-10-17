<template>
  <div>
    <Head title="Create Appointment" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Appointment</h2>
      </template>

      <div class="calendar-container max-w-4xl mx-auto grid grid-cols-7 gap-2 sm:gap-4 p-8">
        <!-- Calendar Header -->
        <div class="col-span-7 text-center font-bold text-lg mb-4">October 2024</div>

        <!-- Days of the Week -->
        <div v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']" :key="day" class="font-semibold text-center text-xs sm:text-sm">
          {{ day }}
        </div>

        <!-- Calendar Days -->
        <div
          v-for="day in daysInMonth"
          :key="day"
          class="p-2 border border-gray-300 rounded-lg flex flex-col items-center justify-center"
        >
          <div class="text-lg font-bold mb-1">{{ day }}</div>

          <!-- Availability Indicator -->
          <div v-if="getAvailabilityForDay(day).length" class="bg-green-200 text-green-800 text-xs sm:text-sm p-1 rounded-full mt-2">
            Available
          </div>
          <div v-else class="bg-red-200 text-red-800 text-xs sm:text-sm p-1 rounded-full mt-2">
            No Slots
          </div>

          <!-- Time Slots Display -->
          <div v-for="availability in getAvailabilityForDay(day)" :key="availability.id" class="mt-2 text-xs text-center font-semibold">
            {{ formatTime(availability.start_time) }} - {{ formatTime(availability.end_time) }}
          </div>
        </div>
      </div>

      <!-- Form Section -->
      <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
          <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Set Appointment Date</h3>
            <div class="mb-4">
              <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
              <input
                type="datetime-local"
                id="appointment_date"
                v-model="form.appointment_date"
                required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              />
              <p class="mt-2 text-sm text-gray-500">Selected Date and Time: {{ formattedAppointmentDate }}</p>
            </div>
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
      </div>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const page = usePage();
const userId = page.props.userId;

const props = defineProps({
  availabilities: {
    type: Array,
    required: true
  }
});

const form = ref({
  patient_id: userId,
  dentist_id: '2',
  appointment_date: '',
  status: 'pending',
});

const daysInMonth = Array.from({ length: 31 }, (_, i) => i + 1);
const getAvailabilityForDay = (day) => {
  return props.availabilities.filter(availability => {
    const availabilityDate = new Date(availability.date).getDate();
    return availabilityDate === day;
  });
};

// Function to format time to 12-hour format
const formatTime = (time) => {
  const [hour, minute] = time.split(':');
  const hours = parseInt(hour, 10);
  const ampm = hours >= 12 ? 'PM' : 'AM';
  const formattedHour = hours % 12 || 12;
  return `${formattedHour}:${minute} ${ampm}`;
};

const formattedAppointmentDate = computed(() => {
  if (!form.value.appointment_date) return '';

  const date = new Date(form.value.appointment_date);
  const options = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  };

  return date.toLocaleString('en-US', options);
});

const handleSubmit = async () => {
  try {
    const formattedDate = new Date(form.value.appointment_date).toISOString();
    const formData = { ...form.value, appointment_date: formattedDate };

    await axios.post(route('appointments.store'), formData);
    Swal.fire({
      icon: 'success',
      title: 'Appointment Created',
      text: 'The appointment has been created successfully.',
      confirmButtonText: 'OK'
    }).then(() => {
      router.visit(route('dashboard'));
    });

    form.value = {
      patient_id: userId,
      dentist_id: '2',
      appointment_date: '',
      status: 'pending',
    };
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'There was a problem creating the appointment.',
      confirmButtonText: 'Try Again'
    });
  }
};
</script>

<style scoped>
.calendar-container {
  max-width: 100%;
  overflow-x: auto;
}

@media (max-width: 640px) {
  .calendar-container {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>
