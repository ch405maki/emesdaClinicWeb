
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
                  <img src="/images/dentallogo.png" alt="Kalinga State University Logo" class="logo w-10 h-10 mr-2">
                  <div>
                      <h1 class="text-lg font-bold">Emes Da Kalinga Dental Clinic</h1>
                      <h2 class="text-md">Individual Dental Health Record</h2>
                  </div>
              </div>

              <div class="pdf-body grid grid-cols-1 gap-y-6">
              <!-- patient Information Card -->
              <div class="overflow-hidden">
              <!-- Patient Information Section -->
              <div class="px-4 py-2">
                <h3 class="text-sm font-medium text-gray-900">Patient Information</h3>
              </div>
              <div class="border-t border-gray-200 px-4 py-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Name: <span class="text-gray-800">{{ appointment.patient.name }}</span>
                    </p>
                  </div>
                  <div class="col-span-2">
                    <p class="text-sm font-medium text-gray-600">
                      Address: <span class="text-gray-800">{{ appointment.patient.address }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Phone: <span class="text-gray-800">{{ appointment.patient.contact }}</span>
                    </p>
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Age: <span class="text-gray-800">{{ appointment.patient.age }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Sex: <span class="text-gray-800">{{ appointment.patient.sex }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Status: <span class="text-gray-800">{{ appointment.patient.civil_status }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Occupation: <span class="text-gray-800">{{ appointment.patient.occupation }}</span>
                    </p>
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Office Address: <span class="text-gray-800">{{ appointment.patient.officeAddress }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Telephone: <span class="text-gray-800">{{ appointment.patient.telNumber }}</span>
                    </p>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-600">
                      Date: <span class="text-gray-800">{{ formattedCreatedAt }}</span>
                    </p>
                  </div>
                </div>
              </div>
                
              <div class="border-t border-gray-200 px-4 py-2">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div>
                  <p class="text-sm font-medium text-gray-600">
                    Occlusion: <span class="text-gray-800">{{ diagnostic.occlusion }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Periodontal Condition: <span class="text-gray-800">{{ diagnostic.condition }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Oral Hygiene: <span class="text-gray-800">{{ diagnostic.hygiene }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Denture Upper: <span class="text-gray-800">{{ diagnostic.denture_upper }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Denture Lower: <span class="text-gray-800">{{ diagnostic.denture_lower }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Abnormalities: <span class="text-gray-800">{{ diagnostic.abnormalities }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    General Condition: <span class="text-gray-800">{{ diagnostic.general_condition }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Physician: <span class="text-gray-800">{{ diagnostic.physician }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Nature of Treatment: <span class="text-gray-800">{{ diagnostic.nature_treatment }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Allergies: <span class="text-gray-800">{{ diagnostic.alergies }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Previous History of Bleeding: <span class="text-gray-800">{{ diagnostic.history }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Chronic Ailments: <span class="text-gray-800">{{ diagnostic.ailments }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Blood Pressure: <span class="text-gray-800">{{ diagnostic.bp }}</span>
                  </p>
                  <p class="text-sm font-medium text-gray-600">
                    Drugs Being Taken: <span class="text-gray-800">{{ diagnostic.drugs }}</span>
                  </p>
                </div>
                <div>
                <!-- Chart Section -->
                <div class="dental-chart">
                  <div class="row">
                    <div v-for="tooth in teethmiddleup" :key="tooth" class="flex items-center mb-2">
                      <input 
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        :value="tooth" 
                        :checked="dentalChart['Middle Operation'] && dentalChart['Middle Operation'][tooth] === true"
                        disabled
                      />
                      <span class="text-gray-800">{{ tooth }}</span>
                    </div>
                  </div>
                </div>

                <div class="dental-chart">
                  <div class="row">
                    <div v-for="tooth in teethmiddledown" :key="tooth" class="flex items-center mb-2">
                      <input 
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        :value="tooth" 
                        :checked="dentalChart['Middle Bottom Operation'] && dentalChart['Middle Bottom Operation'][tooth] === true"
                        disabled
                      />
                      <span class="text-gray-800">{{ tooth }}</span>
                    </div>
                  </div>
                </div>
                <div class="dental-chart">
                  <div class="row">
                    <div v-for="tooth in teethUpper" :key="tooth" class="flex items-center mb-2">
                      <input 
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        :value="tooth" 
                        :checked="dentalChart['Upper Operation'] && dentalChart['Upper Operation'][tooth] === true"
                        disabled
                      />
                      <span class="text-gray-800">{{ tooth }}</span>
                    </div>
                  </div>
                </div>
                <div class="dental-chart">
                  <div class="row">
                    <div v-for="tooth in teethBottom" :key="tooth" class="flex items-center mb-2">
                      <input 
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        :value="tooth" 
                        :checked="dentalChart['Lower Operation'] && dentalChart['Lower Operation'][tooth] === true"
                        disabled
                      />
                      <span class="text-gray-800">{{ tooth }}</span>
                    </div>
                  </div>
                </div>
                <!-- Chart Section -->
                </div>
                </div>

                <div class="border-t border-gray-200 px-4 py-2 mt-8">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-600">Description</dt>
                      <dd class="text-sm text-gray-800">{{ diagnostic.description }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-600">Service Rendered</dt>
                      <dd class="text-sm text-gray-800">{{ diagnostic.service_rendered }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-600">Remarks</dt>
                      <dd class="text-sm text-gray-800">{{ diagnostic.remarks }}</dd>
                    </div>
                </div>
                </div>
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
import { defineProps, ref, onMounted, computed  } from 'vue';
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
  diagnostic: {
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
const teethUpper = [55, 54, 53, 52, 51, 61, 62, 63, 64, 65];
const teethBottom = [85, 84, 83,82, 81, 71, 72, 73, 74, 75];
const teethmiddleup = [18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28];
const teethmiddledown = [48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38];


onMounted(() => {
  if (props.diagnostic && props.diagnostic.dental_chart) {
    try {
      dentalChart.value = JSON.parse(props.diagnostic.dental_chart);
    } catch (error) {
      console.error('Error parsing dental_chart:', error);
    }
  } else {
    // Initialize with default values if diagnostic data is not available
    dentalChart.value = {
      'Upper Operation': [],
      'Lower Operation': [],
    };
  }
});



const updateToothStatus = (section, tooth, status) => {
  if (!dentalChart.value[section]) {
    dentalChart.value[section] = {};
  }
  dentalChart.value[section][tooth] = status;
};


// Format date function
const formattedCreatedAt = computed(() => {
  if (!props.appointment.patient.created_at) return '';

  const date = new Date(props.appointment.patient.created_at);
  return date.toLocaleDateString('en-US', {
    month: '2-digit',
    day: '2-digit',
    year: '2-digit',
  });
});

// Additional fields for appointment
function additionalFields(latestDiagnostic) {
  return {
    "Occlusion": latestDiagnostic.occlusion || 'N/A',
    "Condition": latestDiagnostic.condition || 'N/A',
  };
}

// Export PDF function
const exportPdf = () => {
  const element = document.getElementById('pdf-template');
  element.style.display = 'block';

  const opt = {
    margin: [0.5, 0.5, 0.5, 0.5],
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
    element.style.display = ''; // Hide the PDF template after generating the PDF
  });
};
</script>


<style scoped>
/* Custom styles for better visual appeal */
.pdf-header {
text-align: center;
margin-bottom: 20px;
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
  width: 30px;
  height: 40px;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 1px;
  font-size: 8px;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.chart-image {
  max-width: 75%;
  height: auto;
}

.chart-image-sub {
  max-width: 38%;
  height: auto;
}

.text-dt{
  font-size:13px;
}

.text-dd{
  font-size:11px;
}
</style>
