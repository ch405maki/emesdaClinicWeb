<template>
  <div>
    <Head title="Create Diagnostic" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Diagnostic</h2>
      </template>

      <!-- Main content area -->
      <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 space-y-6">

            <!-- Appointment details section -->
            <div class="mb-4">
              <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Appointment Details</h3>
              <div class="space-y-1 text-sm text-gray-700">
                <p><strong>Date:</strong> {{ formattedDate(props.appointment.appointment_date) }}</p>
                <p><strong>patient:</strong> {{ props.appointment.patient.name }}</p>
                <p><strong>Dentist:</strong> {{ props.appointment.dentist.name }}</p>
                <p><strong>Status:</strong> {{ props.appointment.status }}</p>
              </div>
            </div>

            <!-- Diagnostic form -->
            <form @submit.prevent="submitForm" class="space-y-4">

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
               <!-- Occlusion -->
              <div>
                <label for="occlusion" class="block text-sm font-medium text-gray-700">Occlusion</label>
                <input type="text" v-model="form.occlusion" id="occlusion" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Condition -->
              <div>
                <label for="condition" class="block text-sm font-medium text-gray-700">Condition</label>
                <input type="text" v-model="form.condition" id="condition" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Hygiene -->
              <div>
                <label for="hygiene" class="block text-sm font-medium text-gray-700">Hygiene</label>
                <input type="text" v-model="form.hygiene" id="hygiene" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Denture Upper -->
              <div>
                <label for="denture_upper" class="block text-sm font-medium text-gray-700">Denture Upper</label>
                <input type="text" v-model="form.denture_upper" id="denture_upper" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Denture Lower -->
              <div>
                <label for="denture_lower" class="block text-sm font-medium text-gray-700">Denture Lower</label>
                <input type="text" v-model="form.denture_lower" id="denture_lower" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Since Upper -->
              <div>
                <label for="since_upper" class="block text-sm font-medium text-gray-700">Since Upper</label>
                <input type="text" v-model="form.since_upper" id="since_upper" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Since Lower -->
              <div>
                <label for="since_lower" class="block text-sm font-medium text-gray-700">Since Lower</label>
                <input type="text" v-model="form.since_lower" id="since_lower" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Abnormalities -->
              <div>
                <label for="abnormalities" class="block text-sm font-medium text-gray-700">Abnormalities</label>
                <input type="text" v-model="form.abnormalities" id="abnormalities" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- General Condition -->
              <div>
                <label for="general_condition" class="block text-sm font-medium text-gray-700">General Condition</label>
                <input type="text" v-model="form.general_condition" id="general_condition" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Physician -->
              <div>
                <label for="physician" class="block text-sm font-medium text-gray-700">Physician</label>
                <input type="text" v-model="form.physician" id="physician" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Nature of Treatment -->
              <div>
                <label for="nature_treatment" class="block text-sm font-medium text-gray-700">Nature of Treatment</label>
                <input type="text" v-model="form.nature_treatment" id="nature_treatment" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Allergies -->
              <div>
                <label for="alergies" class="block text-sm font-medium text-gray-700">Allergies</label>
                <input type="text" v-model="form.alergies" id="alergies" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- History -->
              <div>
                <label for="history" class="block text-sm font-medium text-gray-700">History</label>
                <input type="text" v-model="form.history" id="history" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Ailments -->
              <div>
                <label for="ailments" class="block text-sm font-medium text-gray-700">Ailments</label>
                <input type="text" v-model="form.ailments" id="ailments" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Blood Pressure -->
              <div>
                <label for="bp" class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                <input type="text" v-model="form.bp" id="bp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>

              <!-- Drugs -->
              <div>
                <label for="drugs" class="block text-sm font-medium text-gray-700">Drugs</label>
                <input type="text" v-model="form.drugs" id="drugs" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm">
              </div>
              </div>

              <!-- Diagnostic Description -->
              <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Diagnostic Description</label>
                <textarea
                  id="description"
                  v-model="form.description"
                  rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Describe the diagnostic details..."
                  required
                ></textarea>
              </div>

              <!-- Service Rendered -->
              <div>
                <label for="service_rendered" class="block text-sm font-medium text-gray-700">Service Rendered</label>
                <textarea
                  id="service_rendered"
                  v-model="form.service_rendered"
                  rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Describe the services rendered..."
                ></textarea>
              </div>

              <!-- Remarks -->
              <div>
                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                <textarea
                  id="remarks"
                  v-model="form.remarks"
                  rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Additional remarks..."
                ></textarea>
              </div>

              <!-- Status Dropdown -->
              <div class="mb-8 max-w-xl hidden">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select
                  id="status"
                  v-model="form.status"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                >
                  <option value="pending">Pending</option>
                  <option value="confirmed">Confirmed</option>
                  <option value="completed">Completed</option>
                  <option value="canceled">Canceled</option>
                </select>
              </div>

              <!-- Hidden field for appointment ID -->
              <input type="hidden" v-model="form.appointment_id" />

              <!-- dental chart here -->
              <!-- Upper Teeth Section -->
              <div class="dental-chart">
                <!-- Isolate -->
                <div class="flex flex-wrap items-center mb-4">
                  <label class="font-medium text-blue-700 w-full mb-2">Operation:</label>
                  <div v-for="tooth in teeth_upper" :key="tooth" class="flex items-center mr-4 mb-2">
                    <input 
                      type="checkbox" 
                      class="tooth-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      :value="1" 
                      v-model="dentalChartData['Upper Operation'][tooth]" 
                    />
                    <span class="ml-2 text-gray-800">{{ tooth }}</span>
                  </div>
                </div>
                <!-- Isolate -->
                <div class="image-section mb-4 ">
                  <img src="/images/chart/upper.png" alt="Upper Teeth Chart" class="chart-image-sub ml-[8%]" />
                </div>
                <!-- Lower Teeth Section -->
                <div class="dental-chart">
                <div class="flex flex-wrap items-center mb-4">
                  <label class="font-medium text-blue-700 w-full mb-2">Operation:</label>
                  <div v-for="tooth in teeth_bottom" :key="tooth" class="flex items-center mr-4 mb-2">
                    <input 
                      type="checkbox" 
                      class="tooth-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      :value="1" 
                      v-model="dentalChartData['Lower Operation'][tooth]" 
                    />
                    <span class="ml-2 text-gray-800">{{ tooth }}</span>
                  </div>
                </div>
              </div>

                <div class="image-section mt-2">
                  <img src="/images/chart/lower.png" alt="Lower Teeth Chart" class="chart-image-sub ml-[8%]" />
                </div>
              </div>

              <!-- Middle Teeth Section -->
              <div class="dental-chart">
                <div class="row">
                  <label class="row-label text-blue-700">Operation:</label>
                  <div v-for="tooth in teethmiddleup" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input" 
                      maxlength="3"
                      @input="validateInput($event, 'Middle Operation', tooth)"
                    />
                  </div>
                </div>
              </div>

              <div class="image-section">
                <img src="/images/chart/chart1.jpg" alt="Middle Teeth Chart" class="chart-image ml-[5%]" />
              </div>

              <!-- Middle Bottom Teeth Section -->
              <div class="dental-chart">
                <div class="row">
                  <label class="row-label text-blue-700">Operation:</label>
                  <div v-for="tooth in teethmiddledown" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input" 
                      maxlength="3"
                      @input="validateInput($event, 'Middle Bottom Operation', tooth)"
                    />
                  </div>
                </div>
              </div>

              <!-- end dental chart here -->

              <!-- Submit button -->
               <div class="text-center">
                <button
                type="submit"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 mt-6 rounded"
              >
                Submit Diagnostic
              </button>
               </div>
              
            </form>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import { reactive } from 'vue';

  // Define arrays for teeth
  const teethmiddleup = Array.from({ length: 16 }, (_, i) => i + 1);
  const teethmiddledown = Array.from({ length: 16 }, (_, i) => i + 1);
  const teeth_upper = [55, 54, 53, 52, 51, 61, 62, 63, 64, 65];
  const teeth_bottom = [85, 84, 83,82, 81, 71, 72, 73, 74, 75];
// Define props
const props = defineProps({
  appointment: {
    type: Object,
    required: true
  }
});


// Reactive data structure to store inputs
const dentalChartData = reactive({
      'Upper Operation': {},
      'Upper Condition': {},
      'Middle Operation': {},
      'Middle Condition': {},
      'Middle Bottom Operation': {},
      'Middle Bottom Condition': {},
      'Lower Operation': {},
      'Lower Condition': {},
    });

    // Function to validate input and store values in the reactive object
    function validateInput(event, section, tooth) {
      const input = event.target.value.slice(0, 3); // Keep only the first 3 characters
      dentalChartData[section][tooth] = input; // Store the value in the data structure
      console.log(dentalChartData); // Log the structure for debugging
    }


// Create a reactive form object with initial values
const form = ref({
  appointment_id: props.appointment.id,
  occlusion: '',
  condition: '',
  hygiene: '',
  denture_upper: '',
  denture_lower: '',
  since_upper: '',
  since_lower: '',
  abnormalities: '',
  general_condition: '',
  physician: '',
  nature_treatment: '',
  alergies: '',
  history: '',
  ailments: '',
  bp: '',
  drugs: '',
  description: '',
  remarks: '',
  service_rendered: '',
  dental_chart: '',
  status: props.appointment.status
});


// Function to handle form submission
async function submitForm() {
  try {
    console.log('Starting diagnostic creation...');
    console.log('Form data:', {
      appointment_id: form.value.appointment_id,
      description: form.value.description,
      service_rendered: form.value.service_rendered,
      remarks: form.value.remarks,
      dental_chart: dentalChartData
    });
    

    // Update the appointment status immediately after creating the diagnostic
    console.log('Starting appointment status update...');
    // await Inertia.put(`/appointments/${form.value.appointment_id}/update-status`, {
    //   status: form.value.status
    // });

    console.log('Appointment status updated successfully.');

    // Create the diagnostic
    // Create the diagnostic
await Inertia.post('/diagnostic/store', {
  appointment_id: form.value.appointment_id,
  occlusion: form.value.occlusion,
  condition: form.value.condition,
  hygiene: form.value.hygiene,
  denture_upper: form.value.denture_upper,
  denture_lower: form.value.denture_lower,
  since_upper: form.value.since_upper,
  since_lower: form.value.since_lower,
  abnormalities: form.value.abnormalities,
  general_condition: form.value.general_condition,
  physician: form.value.physician,
  nature_treatment: form.value.nature_treatment,
  alergies: form.value.alergies,
  history: form.value.history,
  ailments: form.value.ailments,
  bp: form.value.bp,
  drugs: form.value.drugs,
  description: form.value.description,
  remarks: form.value.remarks,
  service_rendered: form.value.service_rendered,
  dental_chart: dentalChartData, // Assuming this is populated separately
  status: form.value.status
});

    console.log('Diagnostic created successfully.');

    // Show success alert and wait for user confirmation
    const result = await Swal.fire({
      title: 'Success!',
      text: 'Diagnostic created and appointment status updated successfully.',
      icon: 'success',
      confirmButtonText: 'OK'
    });

    // If user confirms, redirect to appointment details
    if (result.isConfirmed) {
      Inertia.visit(`/appointments/${form.value.appointment_id}`);
    }

  } catch (error) {
    console.error('Error occurred:', error);

    // Show error alert
    Swal.fire({
      title: 'Error!',
      text: 'Error in saving Diagnostic or updating appointment status',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  }
}


// Format date function
function formattedDate(dateString) {
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
  return new Date(dateString).toLocaleDateString(undefined, options);
}
</script>

<style scoped>
/* Your styles remain unchanged */
.dental-chart {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.row {
  display: flex;
  align-items: center;
  gap: 5px;
}

.row-label {
  font-weight: bold;
  margin-right: 10px;
  width: 80px; /* Adjust the width to align with your design */
}

.tooth-box {
  display: flex;
  align-items: center;
}

.tooth-input {
  width: 20px;   /* Increased width */
  height: 20px;  /* Increased height */
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px; /* Larger font size */
}

.chart-image {
  max-width: 75%;
  height: auto;
}

.chart-image-sub {
  max-width: 38%;
  height: auto;
}
</style>