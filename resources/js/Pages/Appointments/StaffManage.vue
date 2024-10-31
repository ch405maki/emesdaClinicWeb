<template>
    <div>
        <Head title="Appointment" />

        <AuthenticatedLayout>
            <template #header>
                <div class="flex justify-between items-center h-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Appointment Request</h2>
                    <!-- Search Input Field -->
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
                                        <th class="px-4 py-2 text-left" v-if="!isSmScreen">Time</th>
                                        <th class="px-4 py-2 text-left" v-if="!isSmScreen">Name</th>
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

                                        <template v-if="!isSmScreen">
                                            <td class="px-4 py-2">{{ formatAppointmentTime(appointment.appointment_date) }}</td>
                                            <td class="px-4 py-2 w-1/2">{{ appointment.patient.name }}</td>
                                        </template>

                                        <td class="px-4 py-2 text-center">{{ appointment.status }}</td>
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
    import { ref, computed } from 'vue'; // Import ref and computed for reactivity

    const props = defineProps({
        appointments: {
            type: Array,
            required: true
        }
    });

    // Search query ref
    const searchQuery = ref('');

    // Filtered appointments based on search query
    const filteredAppointments = computed(() => {
        if (!searchQuery.value) {
            return props.appointments;
        }
        const query = searchQuery.value.toLowerCase();
        return props.appointments.filter((appointment) => {
            const patientName = appointment.patient?.name.toLowerCase() || '';
            const appointmentDate = formatDate(appointment.appointment_date).toLowerCase();
            const status = appointment.status.toLowerCase();

            return (
                patientName.includes(query) ||
                appointmentDate.includes(query) ||
                status.includes(query)
            );
        });
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
        const options = { hour: 'numeric', minute: 'numeric', hour12: true };
        return date.toLocaleTimeString([], options);
    };
</script>

<style scoped>
</style>
