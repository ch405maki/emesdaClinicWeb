<template>
  <div>
    <Head title="Create Appointment" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Appointment</h2>
      </template>

      <div class="py-6 px-6">
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
            <h3 class="text-lg font-semibold mb-4">Dental History</h3>
            <div class="mb-4">
              <label for="last_dentist" class="block text-sm font-medium text-gray-700">Last Dentist</label>
              <input
                type="text"
                id="last_dentist"
                v-model="form.last_dentist"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              />
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
              <p class="mt-2 text-sm text-gray-500">Selected Date and Time: {{ formattedAppointmentDate }}</p>
            </div>
          </div>

          <!-- Card for Diseases and Abnormalities -->
          <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Diseases and Abnormalities</h3>
            <div class="mb-4">
              <label for="occlusion" class="block text-sm font-medium text-gray-700">Occlusion</label>
              <input
                type="text"
                id="occlusion"
                v-model="form.occlusion"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div class="mb-4">
              <label for="dent_anomaly" class="block text-sm font-medium text-gray-700">Dental Anomaly</label>
              <input
                type="text"
                id="dent_anomaly"
                v-model="form.dent_anomaly"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              />
            </div>
          </div>

          <!-- Card for Medical History -->
          <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Medical History</h3>
            <!-- Health and Habits -->
            <div class="grid md:grid-cols-2 md:gap-6">
              <!-- Good Health -->
              <div class="mb-4">
                <label for="good_health" class="block text-sm font-medium text-gray-700">Are you in good health?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="good_health_yes" :value="true" v-model="form.good_health" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="good_health_yes" class="mr-4">Yes</label>
                  <input type="radio" id="good_health_no" :value="false" v-model="form.good_health" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="good_health_no">No</label>
                </div>
                <div v-if="form.good_health === false" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify..."
                    v-model="form.good_health_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>

              <!-- Medical Treatment -->
              <div class="mb-4">
                <label for="medical_treatment" class="block text-sm font-medium text-gray-700">Are you receiving medical treatment?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="medical_treatment_yes" :value="true" v-model="form.medical_treatment" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="medical_treatment_yes" class="mr-4">Yes</label>
                  <input type="radio" id="medical_treatment_no" :value="false" v-model="form.medical_treatment" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="medical_treatment_no">No</label>
                </div>
                <div v-if="form.medical_treatment === false" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify..."
                    v-model="form.medical_treatment_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>

              <!-- Surgical Operation -->
              <div class="mb-4">
                <label for="surgical_operation" class="block text-sm font-medium text-gray-700">Have you had any surgical operations?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="surgical_operation_yes" :value="true" v-model="form.surgical_operation" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="surgical_operation_yes" class="mr-4">Yes</label>
                  <input type="radio" id="surgical_operation_no" :value="false" v-model="form.surgical_operation" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="surgical_operation_no">No</label>
                </div>
                <div v-if="form.surgical_operation === false" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify..."
                    v-model="form.surgical_operation_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>

              <!-- Hospitalized -->
              <div class="mb-4">
                <label for="hospitalized" class="block text-sm font-medium text-gray-700">Have you been hospitalized?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="hospitalized_yes" :value="true" v-model="form.hospitalized" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="hospitalized_yes" class="mr-4">Yes</label>
                  <input type="radio" id="hospitalized_no" :value="false" v-model="form.hospitalized" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="hospitalized_no">No</label>
                </div>
                <div v-if="form.hospitalized === true" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify..."
                    v-model="form.hospitalized_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>
            </div>

            <!-- Tobacco and Alcohol -->
            <div class="grid md:grid-cols-2 md:gap-6">
              <!-- Tobacco -->
              <div class="mb-4">
                <label for="tobacco" class="block text-sm font-medium text-gray-700">Do you use tobacco?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="tobacco_yes" :value="true" v-model="form.tobacco" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="tobacco_yes" class="mr-4">Yes</label>
                  <input type="radio" id="tobacco_no" :value="false" v-model="form.tobacco" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="tobacco_no">No</label>
                </div>
                <div v-if="form.tobacco === true" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify frequency or details..."
                    v-model="form.tobacco_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>
              <!-- Alcohol -->
              <div class="mb-4">
                <label for="alcohol" class="block text-sm font-medium text-gray-700">Do you consume alcohol?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="alcohol_yes" :value="true" v-model="form.alcohol" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="alcohol_yes" class="mr-4">Yes</label>
                  <input type="radio" id="alcohol_no" :value="false" v-model="form.alcohol" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="alcohol_no">No</label>
                </div>
                <div v-if="form.alcohol === true" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify frequency or details..."
                    v-model="form.alcohol_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>
            </div>

            <!-- Pregnancy and Additional Fields -->
            <div class="grid md:grid-cols-2 md:gap-6">
              <!-- Pregnant -->
              <div class="mb-4">
                <label for="pregnant" class="block text-sm font-medium text-gray-700">Are you pregnant?</label>
                <div class="flex items-center mt-1">
                  <input type="radio" id="pregnant_yes" :value="true" v-model="form.pregnant" class="mr-2 rounded-full border-gray-400 text-green-500 focus:ring-2 focus:ring-green-500" />
                  <label for="pregnant_yes" class="mr-4">Yes</label>
                  <input type="radio" id="pregnant_no" :value="false" v-model="form.pregnant" class="mr-2 rounded-full border-gray-400 text-red-500 focus:ring-2 focus:ring-red-500" />
                  <label for="pregnant_no">No</label>
                </div>
                <div v-if="form.pregnant === true" class="mt-2">
                  <input
                    type="text"
                    placeholder="Please specify details..."
                    v-model="form.pregnant_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                  />
                </div>
              </div>
              <!-- Medications -->
              <div class="mb-4">
                <label for="medication" class="block text-sm font-medium text-gray-700">Medications</label>
                <input
                  type="text"
                  id="medication"
                  v-model="form.medication"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                />
              </div>
              <!-- Allergies -->
              <div class="mb-4">
                <label for="allergy" class="block text-sm font-medium text-gray-700">Allergies</label>
                <input
                  type="text"
                  id="allergy"
                  v-model="form.allergy"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                />
              </div>
              <!-- Other Information -->
              <div class="mb-4">
                <label for="other" class="block text-sm font-medium text-gray-700">Other Information</label>
                <input
                  type="text"
                  id="other"
                  v-model="form.other"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                />
              </div>
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
  last_dentist: '',
  occlusion: '',
  dent_anomaly: '',
  good_health: '',  // true or false
  good_health_details: '',
  medical_treatment: '',  // true or false
  medical_treatment_details: '',
  surgical_operation: '',  // true or false
  surgical_operation_details: '',
  hospitalized: '',  // true or false
  hospitalized_details: '',
  medication: '',
  tobacco: '',  // true or false
  tobacco_details: '',
  alcohol: '',  // true or false
  alcohol_details: '',
  allergy: '',
  pregnant: '',  // true or false or null
  pregnant_details: '',
  other: ''
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
      last_dentist: '',
      occlusion: '',
      dent_anomaly: '',
      good_health: '',
      good_health_details: '',
      medical_treatment: '',
      medical_treatment_details: '',
      surgical_operation: '',
      surgical_operation_details: '',
      hospitalized: '',
      hospitalized_details: '',
      medication: '',
      tobacco: '',
      tobacco_details: '',
      alcohol: '',
      alcohol_details: '',
      allergy: '',
      pregnant: '',
      pregnant_details: '',
      other: ''
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
