<template>
    <div>
    <Head title="Appointment" />

    <AuthenticatedLayout>
        <template #header>
        <div class="flex justify-between items-center h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Appointment Request</h2>
        </div>
        </template>
        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 rounded-lg">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-200">
                    <!-- Conditional rendering based on screen size -->
                    <th class="px-4 py-2 text-left" v-if="isSmScreen || !isSmScreen">Date</th>
                    <th class="px-4 py-2 text-left" v-if="!isSmScreen">Time</th>
                    <th class="px-4 py-2 text-left" v-if="!isSmScreen">Name</th>
                    <th class="px-4 py-2" v-if="isSmScreen || !isSmScreen">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr
                    v-for="appointment in appointments"
                    :key="appointment.id"
                    class="border-b border-gray-200 hover:bg-gray-100"
                    >
                    <!-- Always show Date column -->
                    <td class="px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>

                    <template v-if="!isSmScreen">
                        <td class="px-4 py-2">{{ formatAppointmentTime(appointment.appointment_date) }}</td>
                        <td class="px-4 py-2">{{ appointment.status}}</td>
                    </template>

                    <!-- Always show Actions column -->
                    <td class="px-4 py-2 text-center">
                        <button
                        @click="handleAction(appointment.id)"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                        >
                        Show
                        </button>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </AuthenticatedLayout>
    </div>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, router, usePage } from '@inertiajs/vue3';

    const props = defineProps({
    appointments: {
        type: Array,
        required: true
    }
    });

    const handleAction = (appointmentId) => {
        router.get(route('appointments.view', appointmentId));
    };

    const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = { month: 'long', day: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
    };

    const formatAppointmentTime = (dateString) => {
    const date = new Date(dateString);
    
    // Options for formatting
    const options = { hour: 'numeric', minute: 'numeric', hour12: true };
    
    // Format date to a string
    return date.toLocaleTimeString([], options);
    };
</script>

<style scoped>
</style>