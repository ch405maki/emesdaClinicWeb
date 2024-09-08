<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="flex justify-center mb-8">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <form @submit.prevent="submit">
            <div v-if="step === 1">
                <!-- Name -->
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <!-- Role Selection -->
                <div class="mt-4 hidden">
                    <InputLabel for="role" value="Role" />
                    <select id="role" v-model="form.role" class="mt-1 block w-full" required>
                        <option value="" disabled>Select Role</option>
                        <option value="student">Student</option>
                        <option value="dentist">Dentist</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <!-- Additional Fields -->
                <!-- Age -->
                <div class="mt-4">
                    <InputLabel for="age" value="Age" />
                    <TextInput
                        id="age"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.age"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.age" />
                </div>

                <!-- Sex -->
                <div class="mt-4">
                    <InputLabel for="sex" value="Sex" />
                    <select id="sex" v-model="form.sex" class="mt-1 block w-full" required>
                        <option value="" disabled>Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.sex" />
                </div>

                <!-- Civil Status -->
                <div class="mt-4">
                    <InputLabel for="civil_status" value="Civil Status" />
                    <select id="civil_status" v-model="form.civil_status" class="mt-1 block w-full" required>
                        <option value="" disabled>Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.civil_status" />
                </div>

                <!-- Course Year -->
                <div class="mt-4">
                    <InputLabel for="course_year" value="Course/Year" />
                    <TextInput
                        id="course_year"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.course_year"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.course_year" />
                </div>

                <!-- Contact -->
                <div class="mt-4">
                    <InputLabel for="contact" value="Contact" />
                    <TextInput
                        id="contact"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.contact"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.contact" />
                </div>

                <!-- Position -->
                <div class="mt-4">
                    <InputLabel for="position" value="Position" />
                    <TextInput
                        id="position"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.position"
                    />
                    <InputError class="mt-2" :message="form.errors.position" />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <InputLabel for="address" value="Address" />
                    <TextInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address"
                    />
                    <InputError class="mt-2" :message="form.errors.address" />
                </div>

                <!-- Next Button -->
                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton @click="nextStep" class="ms-4">
                        Next
                    </PrimaryButton>
                </div>
            </div>

            <div v-if="step === 2">
                <!-- In Case of Emergency Fields -->
                <div class="mt-4">
                    <InputLabel for="ioe_name" value="In Case of Emergency: Name" />
                    <TextInput
                        id="ioe_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ioe_name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.ioe_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="ioe_relation" value="In Case of Emergency: Relation" />
                    <TextInput
                        id="ioe_relation"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ioe_relation"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.ioe_relation" />
                </div>

                <div class="mt-4">
                    <InputLabel for="ioe_address" value="In Case of Emergency: Address" />
                    <TextInput
                        id="ioe_address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ioe_address"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.ioe_address" />
                </div>

                <div class="mt-4">
                    <InputLabel for="ioe_contact" value="In Case of Emergency: Contact" />
                    <TextInput
                        id="ioe_contact"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ioe_contact"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.ioe_contact" />
                </div>

                <!-- Back and Register Buttons -->
                <div class="flex items-center justify-between mt-4">
                    <div>
                        <Link
                            :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Already registered?
                        </Link>
                        <PrimaryButton @click="prevStep" class="ms-4 bg-red-500">
                            Back
                        </PrimaryButton>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const step = ref(1);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'student',
    age: '',           // New field
    sex: '',           // New field
    civil_status: '',  // New field
    course_year: '',   // New field
    contact: '',       // New field
    position: '',      // New field
    address: '',       // New field
    ioe_name: '',      // New field (In case of emergency)
    ioe_relation: '',  // New field (In case of emergency)
    ioe_address: '',   // New field (In case of emergency)
    ioe_contact: ''    // New field (In case of emergency)
});

const nextStep = () => {
    step.value = 2;
};

const prevStep = () => {
    step.value = 1;
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset(
            'password',
            'password_confirmation',
            'role',
            'age',
            'sex',
            'civil_status',
            'course_year',
            'contact',
            'position',
            'address',
            'ioe_name',
            'ioe_relation',
            'ioe_address',
            'ioe_contact'
        ),
    });
};
</script>