
<template>
<div>
  <Head title="Individual Dental Health Record" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Individual Dental Health Record</h2>
        <button v-if="userRole !== 'patient'" @click="exportPdf" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center space-x-2">
          <span class="material-icons">picture_as_pdf</span>
          <span>Export PDF</span>
        </button>
      </div>
  </template>

    <div id="pdf-content" class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" >
        <!-- Diagnostic Information Card -->
        
        <!-- Diagnostic Information Card -->
        

        <!-- PDF template content -->
          <div id="pdf-template">
              <div class="pdf-header flex items-center justify-center">
                  <img src="/images/dentallogo.png" alt="Kalinga State University Logo" class="logo w-6 h-6 mr-2">
                  <div>
                      <h1 class="text-xl font-bold">Emes Da Kalinga Dental Clinic</h1>
                      <h2 class="text-lg">Individual Dental Health Record</h2>
                  </div>
              </div>

              <div class="pdf-body grid grid-cols-1 gap-y-6">
                  <!-- Diagnostic Information -->
                  <div v-if="appointment.diagnostic" class="bg-white overflow-hidden">
                  <div class="px-4 py-2">
                    <h3 class="text-base leading-6 font-medium text-gray-900">Diagnostic Information</h3>
                  </div>
                  <div class="border-t border-gray-200 px-4 py-2">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                      <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.description || 'No diagnostic available' }}</dd>
                      </div>
                      <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Service Rendered</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.service_rendered || 'No Service Rendered available' }}</dd>
                      </div>
                      <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Remarks</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.remarks || 'No Remarks available' }}</dd>
                      </div>
                    </dl>
                  </div>

                  <div class="px-4 py-2">
                    <h3 class="text-base leading-6 font-medium text-gray-900">Appointment Information</h3>
                  </div>
                  <div class="border-t border-gray-200 px-4 py-2 sm:p-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-4">
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Status</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ appointment.status }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Appointment Date</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ formattedDate(appointment.appointment_date) }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Occlusion</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic.occlusion }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Condition</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic.condition }}</dd>
                    </div>
                    </dl>
                  </div>
                </div>

              <!-- Odonto-stomatological Record -->
              <div class="bg-white overflow-hidden px-4">
              <div class="py-2">
                <h3 class="text-base leading-6font-medium text-gray-900">Odonto-stomatological Record</h3>
              </div>
              <!-- Upper Teeth Section -->
              <div class="dental-chart">
                <div class="row">
                <label class="text-blue-700 mb-4">Operation:</label>
                <div v-for="tooth in teethUpper" :key="tooth" style="display: flex; align-items: center;">
                  <input 
                    style="
                      width: 30px;
                      height: 40px;
                      text-align: center;
                      border: 1px solid #ccc;
                      border-radius: 1px;
                      font-size: 8px;
                      margin: 0;
                      padding: 0;
                      display: flex;  /* Ensures the box uses flexbox */
                      justify-content: center;  /* Centers content horizontally */
                      align-items: center;  /* Centers content vertically */
                    "
                    type="text" 
                    maxlength="3"
                    :value="dentalChart['Upper Operation']?.[tooth] || ''"
                    readonly
                  />
                </div>
                </div>

                <div class="row">
                  <label class="text-red-700">Condition:</label>
                  <div v-for="tooth in teethUpper" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Upper Condition']?.[tooth] || ''"
                      @input="validateInput($event, 'Upper Condition', tooth)"
                      readonly
                    />
                  </div>
                </div>
              </div>

              <div class="image-section mb-8 mt-2">
                <img src="/images/chart/upper.png" alt="Upper Teeth Chart" class="chart-image-sub ml-[6%]" />
              </div>

              <!-- Middle Teeth Section -->
              <div class="dental-chart">
                <div class="row">
                  <label class="text-blue-700">Operation:</label>
                  <div v-for="tooth in teethMiddleUp" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Middle Operation']?.[tooth] || ''"
                      @input="validateInput($event, 'Middle Operation', tooth)"
                      readonly
                    />
                  </div>
                </div>
                <div class="row">
                  <label class="text-red-700">Condition:</label>
                  <div v-for="tooth in teethMiddleUp" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Middle Condition']?.[tooth] || ''"
                      @input="validateInput($event, 'Middle Condition', tooth)"
                      readonly
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
                  <label class="text-blue-700">Operation:</label>
                  <div v-for="tooth in teethMiddleDown" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Middle Bottom Operation']?.[tooth] || ''"
                      @input="validateInput($event, 'Middle Bottom Operation', tooth)"
                      readonly
                    />
                  </div>
                </div>
                <div class="row">
                  <label class="text-red-700">Condition:</label>
                  <div v-for="tooth in teethMiddleDown" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Middle Bottom Condition']?.[tooth] || ''"
                      @input="validateInput($event, 'Middle Bottom Condition', tooth)"
                      readonly
                    />
                  </div>
                </div>
              </div>

              <div class="image-section mt-8 mb-4">
                <img src="/images/chart/lower.png" alt="Lower Teeth Chart" class="chart-image-sub ml-[6%]" />
              </div>

              <!-- Lower Teeth Section -->
              <div class="dental-chart">
                <div class="row">
                  <label class="text-blue-700">Operation:</label>
                  <div v-for="tooth in teethBottom" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Lower Operation']?.[tooth] || ''"
                      @input="validateInput($event, 'Lower Operation', tooth)"
                      readonly
                    />
                  </div>
                </div>
                <div class="row">
                  <label class="text-red-700">Condition:</label>
                  <div v-for="tooth in teethBottom" :key="tooth" class="tooth-box">
                    <input 
                      type="text" 
                      class="tooth-input"
                      maxlength="3"
                      :value="dentalChart['Lower Condition']?.[tooth] || ''"
                      @input="validateInput($event, 'Lower Condition', tooth)"
                      readonly
                    />
                  </div>
                </div>
              </div>
            </div>
              <!-- Odonto-stomatological Record -->

              <!-- patient Information Card -->
              <div class="bg-white overflow-hidden">
                <div class="px-4 py-2">
                  <h3 class="text-base leading-6 font-medium text-gray-900">Patient Information</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-2">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-3">
                    <div class="sm:col-span-1" v-for="(value, key) in patientFields(appointment.patient)" :key="key">
                      <dt class="text-sm font-medium text-gray-500">{{ key }}</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ value }}</dd>
                    </div>
                  </dl>
                </div>
                <div class="px-4 py-2">
                  <h3 class="text-base leading-6 font-medium text-gray-900">Dentist Information</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-2">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Name</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ appointment.dentist.name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Email</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ appointment.dentist.email }}</dd>
                    </div>
                  </dl>
                </div>
              </div>
              </div>
          </div>
          <!-- end of pdf template -->
      </div>
    </div>
  </AuthenticatedLayout>
</div>
</template>
<script setup>
import { defineProps, ref, onMounted   } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import 'material-icons/iconfont/material-icons.css';
import html2pdf from 'html2pdf.js';
import jsPDF from 'jspdf';


// Define props to access data passed from the controller
const props = defineProps({
  appointment: {
    type: Object,
    required: true
  },
  latestDiagnostic: {
    type: Object,
    required: false,
  },
  
  userRole: {
    type: String,
    required: true
  }
});

const dentalChart = ref({});

// Initialize teeth arrays
const teethUpper = Array.from({ length: 10 }, (_, i) => (i + 1).toString());
const teethMiddleUp = Array.from({ length: 16 }, (_, i) => (i + 1).toString());
const teethMiddleDown = Array.from({ length: 16 }, (_, i) => (i + 1).toString());
const teethBottom = Array.from({ length: 10 }, (_, i) => (i + 1).toString());

// Parse dental chart JSON
onMounted(() => {
  if (props.latestDiagnostic && props.latestDiagnostic.dental_chart) {
    try {
      dentalChart.value = JSON.parse(props.latestDiagnostic.dental_chart);
    } catch (error) {
      console.error('Error parsing dental_chart:', error);
    }
  }
});


// Parse dental chart JSON
onMounted(() => {
  if (props.latestDiagnostic && props.latestDiagnostic.dental_chart) {
    try {
      dentalChart.value = JSON.parse(props.latestDiagnostic.dental_chart);
    } catch (error) {
      console.error('Error parsing dental_chart:', error);
    }
  }
});


// Format date function
function formattedDate(dateString) {
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
  return new Date(dateString).toLocaleDateString(undefined, options);
}

// Additional fields for appointment
function additionalFields(latestDiagnostic) {
  return {
    "Occlusion": latestDiagnostic.occlusion || 'N/A',
    "Condition": latestDiagnostic.condition || 'N/A',
  };
}

// patient fields
function patientFields(patient) {
  return {
    "Name": patient.name,
    "Email": patient.email,
    "Role": patient.role,
    "Age": patient.age,
    "Sex": patient.sex,
    "Civil Status": patient.civil_status,
    "Contact": patient.contact,
    "Address": patient.address,
  };
}

// Export PDF function
const exportPdf = () => {
  const element = document.getElementById('pdf-template');
  element.style.display = 'block'; // Show the PDF template

  const opt = {
    margin: [0.5, 0.5, 0.5, 0.5], // Adjust margins as needed
    filename: 'Individual_Dental_Health_Record.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
  };

  // Convert the HTML content to PDF
  html2pdf().from(element).set(opt).toPdf().get('pdf').then((pdfObj) => {
    // Add the custom header to each page
    const totalPages = pdfObj.internal.getNumberOfPages();
    for (let i = 1; i <= totalPages; i++) {
      pdfObj.setPage(i);
      // Add custom header content here if needed
    }
  }).save().finally(() => {
    element.style.display = 'none'; // Hide the PDF template after generating the PDF
  });
};
</script>


<style scoped>
/* Custom styles for better visual appeal */
.pdf-header {
text-align: center;
margin-bottom: 20px;
}
.pdf-header .logo {
width: 100px;
height: auto;
}
.pdf-body {
padding: 20px;
}
.pdf-hidden {
display: none;
}

.dental-chart {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.row {
  display: flex;
  align-items: center;
  gap: 5px;
}

.row-label {
  font-weight: bold;
  margin-right: 20px;
  width: 80px; /* Adjust the width to align with your design */
}

.tooth-box {
  display: flex;
  align-items: center;
}

.tooth-input {
  width: 40px;   /* Increased width */
  height: 40px;  /* Increased height */
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
