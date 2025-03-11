<template>
    <div>
        <Head title="Reports" />

        <AuthenticatedLayout>
            <template #header>
                <div class="flex justify-between items-center h-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        History of : {{ appointments.length > 0 ? appointments[0]?.patient?.name : 'Unknown' }}
                    </h2>
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
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-left" v-if="!isSmScreen">Diagnosis</th>
                                        <th class="px-4 py-2 text-left" v-if="!isSmScreen">Patient</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    <tr v-for="appointment in filteredAppointments" :key="appointment.id" class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>

                                        <template v-if="!isSmScreen">
                                            <td class="px-4 py-2">{{ appointment.diagnostic?.description || 'No description available' }}</td>
                                            <td class="px-4 py-2">{{ appointment.patient?.name || 'No patient' }}</td>
                                        </template>

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
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, router } from '@inertiajs/vue3';

// Initialize search query and isSmScreen
const searchQuery = ref('');

// Access page props from the server
const { props } = usePage();
const appointments = ref(props.appointments || []);
const role = ref(props.role || ''); // Access the role passed from the controller

const isSmScreen = window.innerWidth < 640;

onMounted(() => {
    // Re-assign appointments in case they’re updated dynamically
    appointments.value = props.appointments || [];
});

// Filtered appointments based on search query
const filteredAppointments = computed(() => {
    if (!searchQuery.value) return appointments.value;

    const query = searchQuery.value.toLowerCase();
    return appointments.value.filter((appointment) => {
        const appointmentDate = formatDate(appointment.appointment_date).toLowerCase();
        const diagnosisDescription = appointment.diagnostic?.description?.toLowerCase() || '';
        const patientName = appointment.patient?.name?.toLowerCase() || '';
        const dentistName = appointment.dentist?.name?.toLowerCase() || '';

        return (
            diagnosisDescription.includes(query) ||
            patientName.includes(query) ||
            dentistName.includes(query) ||
            appointmentDate.includes(query)
        );
    });
});

// Navigate to report details
const handleAction = (appointmentId) => {
    router.get(route('reports.show', appointmentId));
};

// Date formatter
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
