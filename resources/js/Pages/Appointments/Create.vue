<template>
  <div>
    <Head title="Create Appointment" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Appointment</h2>
      </template>

      <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8 ">
          <!-- Hidden fields for IDs and status -->
          <div class="mb-4 hidden">
            <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient ID</label>
            <input
              type="text"
              id="patient_id"
              v-model="form.patient_id"
              readonly
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100"
            />
          </div>
          <div class="mb-4 hidden">
            <label for="dentist_id" class="block text-sm font-medium text-gray-700">Dentist ID</label>
            <input
              type="text"
              id="dentist_id"
              v-model="form.dentist_id"
              required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            />
          </div>
          <div class="mb-4 hidden">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select
              id="status"
              v-model="form.status"
              required
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
              <option value="pending">Pending</option>
              <option value="confirmed">Confirmed</option>
              <option value="completed">Completed</option>
              <option value="canceled">Canceled</option>
            </select>
          </div>

          <!-- Card for Dental History -->
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
            <!-- Submit Button -->
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

const form = ref({
  patient_id: userId,
  dentist_id: '2',
  appointment_date: '',
  status: 'pending',
});

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
    // Ensure the date is in the correct format before sending it to the server
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

    // Reset the form after successful submission
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
