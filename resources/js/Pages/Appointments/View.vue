<template>
    <div>
      <Head title="Appointment Details" />
  
      <AuthenticatedLayout>
        <template #header>
          <div class="flex justify-between items-center h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointment Details</h2>
            <div v-if="user.role === 'dentist'">
              <button @click="cancel" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
                Cancel
              </button>
              <button @click="confirm" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Confirm
              </button>
            </div>
          </div>
        </template>
  
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 space-y-6">
            <div class="bg-white shadow overflow-hidden rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Appointment Information</h3>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm">
                      <span :class="statusClass(appointment.status)">
                        <div class="font-bold text-lg">{{ appointment.status }}</div>
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Appointment Date</dt>
                    <dd class="mt-1 text-gray-900 font-medium text-lg">{{ formattedDate(appointment.appointment_date) }}</dd>
                  </div>
                </dl>
              </div>
            </div>
  
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Patient Information</h3>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                  <div class="sm:col-span-1" v-for="(value, key) in patientFields(appointment.patient)" :key="key">
                    <dt class="text-sm font-medium text-gray-500">{{ key }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ value }}</dd>
                  </div>
                </dl>
              </div>
            </div>
  
            <div class="bg-white shadow overflow-hidden sm:rounded-lg hidden">
              <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Dentist Information</h3>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
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
      </AuthenticatedLayout>
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  import { Head, router } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Swal from 'sweetalert2';
  import { usePage } from '@inertiajs/vue3';
  
  // Define props
  const props = defineProps({
    appointment: {
      type: Object,
      required: true
    },
      user: {
          type: Array,
          required: true
      }
  });
  
  // Format date function
  function formattedDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
    return new Date(dateString).toLocaleDateString(undefined, options);
  }
  
  function confirm() {
    const data = { status: 'confirmed' };

    // Make a PUT request to update the appointment status
    router.put(`/appointments/${props.appointment.id}/update-status`, data, {
        onSuccess: (page) => {
        // Check if the flash message is in the page object
        const successMessage = page?.props?.flash?.success || 'Appointment status updated successfully.';

        // Display success message using SweetAlert
        Swal.fire({
            title: 'Success!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Redirect to appointment management page after clicking OK
            router.visit('/appointments/manage');
        });

        // Update local appointment status
        props.appointment.status = 'confirmed'; // Update local state
        },
        onError: (errors) => {
        // Handle error response and show error alert
        Swal.fire({
            title: 'Error!',
            text: 'There was a problem updating the appointment status.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        console.error("Error updating appointment status:", errors);
        }
    });
    }

    // Cancel appointment status
    function cancel() {
    const data = { status: 'canceled' };

    // Make a PUT request to update the appointment status
    router.put(`/appointments/${props.appointment.id}/update-status`, data, {
        onSuccess: (page) => {
        const successMessage = page?.props?.flash?.success || 'Appointment status updated successfully.';

        // Display success message using SweetAlert
        Swal.fire({
            title: 'Success!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Optional: Redirect to appointment manage page
            router.visit('/appointments/manage');
        });

        // Update local appointment status
        props.appointment.status = 'canceled'; // Update local state
        },
        onError: (errors) => {
        // Handle error response and show error alert
        Swal.fire({
            title: 'Error!',
            text: 'There was a problem canceling the appointment.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        console.error("Error canceling appointment:", errors);
        }
    });
    }


  // Method to generate fields for patient information
  function patientFields(patient) {
    return {
      "Name": patient.name,
      "Address": patient.address,
      "Email": patient.email,
      "Contact": patient.contact,
      "Age": patient.age,
      "Sex": patient.sex,
      "Civil Status": patient.civil_status,
      "Occupation": patient.occupation,
      "Office Address": patient.officeAddress,
      "Tel. Number": patient.telNumber,
    };
  }
  
  // Function to determine status background color class
  function statusClass(status) {
    switch (status) {
      case 'pending':
        return 'bg-yellow-200 text-yellow-800';
      case 'confirmed':
        return 'bg-green-200 text-green-800';
      case 'completed':
        return 'bg-blue-200 text-blue-800';
      case 'canceled':
        return 'bg-red-200 text-red-800';
      default:
        return 'bg-gray-200 text-gray-800';
    }
  }
  </script>
  
  <style scoped>
  /* Additional custom styles if needed */
  .bg-yellow-200 {
    background-color: #FEF3C7;
  }
  .bg-green-200 {
    background-color: #D1FAE5;
  }
  .bg-blue-200 {
    background-color: #BFDBFE;
  }
  .bg-red-200 {
    background-color: #FEE2E2;
  }
  </style>
  