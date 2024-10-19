<template>
    <div>
    <Head title="Reports" />

    <AuthenticatedLayout>
        <template #header>
        <div class="flex justify-between items-center h-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h2>
            <input
            type="text"
            v-model="searchQuery"
            placeholder="Search..."
            class="mt-1 block w-2/3 sm:w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
        </div>
        </template>

        <div class="py-6">
            <div class="mx-auto px-4 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 rounded-lg">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-200">
                    <!-- Conditional rendering based on screen size -->
                    <th class="px-4 py-2 text-left" v-if="isSmScreen || !isSmScreen">Date</th>
                    <th class="px-4 py-2 text-left" v-if="!isSmScreen">Diagnosis</th>
                    <th class="px-4 py-2 text-left" v-if="!isSmScreen">Dentist</th>
                    <th class="px-4 py-2" v-if="isSmScreen || !isSmScreen">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr
                    v-for="appointment in filteredAppointments"
                    :key="appointment.id"
                    class="border-b border-gray-200 hover:bg-gray-100"
                    >
                    <!-- Always show Date column -->
                    <td class="px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>

                    <!-- Conditionally show other columns based on screen size -->
                    <template v-if="!isSmScreen">
                        <td class="px-4 py-2">{{ appointment.diagnostic?.description || 'No description available' }}</td>
                        <td class="px-4 py-2">{{ appointment.dentist?.name || 'No dentist' }}</td>
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
import { ref, onMounted, computed } from 'vue'; // Import computed from vue
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, router } from '@inertiajs/vue3';

// Initialize appointments and search query
const appointments = ref([]);
const searchQuery = ref('');

// Get the appointments data from the page props
const { props } = usePage();

// Detect screen size to determine column visibility
const isSmScreen = window.innerWidth < 640; // Adjust breakpoint as per your design

onMounted(() => {
    appointments.value = props.appointments || [];
});

// Computed property to filter appointments based on search query
const filteredAppointments = computed(() => {
    if (!searchQuery.value) {
    return appointments.value;
    }
    return appointments.value.filter((appointment) => {
    return (
        appointment.diagnostic?.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        appointment.student?.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        appointment.dentist?.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        formatDate(appointment.appointment_date).toLowerCase().includes(searchQuery.value.toLowerCase())
    );
    });
});

// Define method to handle actions
const handleAction = (appointmentId) => {
    // Use the Inertia router to navigate to the show page
    router.get(route('reports.show', appointmentId));
};

// Define method to format date
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = { month: 'long', day: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
};
</script>

<style scoped>
.nav-link {
    color: white;
}
</style>