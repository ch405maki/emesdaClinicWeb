<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="flex justify-center mb-8">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <form @submit.prevent="submit">
            <!-- Name -->
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password Input with Eye Icon -->
<div class="space-y-2">
    <div>
        <label for="password" class="text-gray-600 mb-2 block">Password</label>

        <div class="relative">
            <!-- Password Input -->
            <input
                :type="showPassword ? 'text' : 'password'"
                id="password"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400 pr-12"
                v-model="form.password"
                placeholder="***********"
                required
                autocomplete="new-password"
            />

            <!-- Eye Icon Button -->
            <button
                type="button"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 hover:text-gray-900"
                @click="togglePassword"
            >
                <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'" class="text-lg"></i>
            </button>
        </div>
        <InputError class="mt-2" :message="form.errors.password" />
    </div>
</div>

<!-- Confirm Password Input with Eye Icon -->
<div class="space-y-2 mt-4">
    <div>
        <label for="password_confirmation" class="text-gray-600 mb-2 block">Confirm Password</label>

        <div class="relative">
            <!-- Confirm Password Input -->
            <input
                :type="showConfirmPassword ? 'text' : 'password'"
                id="password_confirmation"
                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400 pr-12"
                v-model="form.password_confirmation"
                placeholder="***********"
                required
                autocomplete="new-password"
            />

            <!-- Eye Icon Button -->
            <button
                type="button"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 hover:text-gray-900"
                @click="toggleConfirmPassword"
            >
                <i :class="showConfirmPassword ? 'fas fa-eye' : 'fas fa-eye-slash'" class="text-lg"></i>
            </button>
        </div>
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
    </div>
</div>


            <!-- Additional Fields -->
            <div class="mt-4">
                <InputLabel for="age" value="Age" />
                <TextInput id="age" type="number" class="mt-1 block w-full" v-model="form.age" required />
                <InputError class="mt-2" :message="form.errors.age" />
            </div>

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

            <div class="mt-4">
                <InputLabel for="contact" value="Number" /><span class="text-xs text-gray-800">Follow this Format: </span><span class="text-xs text-red-500 italic">9876543210</span>
                
                <div class="relative flex">
                    <span class="flex items-center px-3 bg-gray-200 border border-gray-300 text-gray-600 rounded-l">
                        +63
                    </span>
                    <TextInput
                        id="contact"
                        type="text"
                        class="mt-1 block w-full rounded-l-none"
                        v-model="form.contact"
                        required
                        @input="formatContactNumber"
                        placeholder="9876543210"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.contact" />
            </div>


            <div class="mt-4">
                <InputLabel for="address" value="Address" />
                <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="mt-4">
                <InputLabel for="occupation" value="Occupation" />
                <TextInput id="occupation" type="text" class="mt-1 block w-full" v-model="form.occupation" required />
                <InputError class="mt-2" :message="form.errors.occupation" />
            </div>

            <div class="mt-4">
                <InputLabel for="officeAddress" value="Office Address" />
                <TextInput id="officeAddress" type="text" class="mt-1 block w-full" v-model="form.officeAddress" required />
                <InputError class="mt-2" :message="form.errors.officeAddress" />
            </div>

            <div class="mt-4">
                <InputLabel for="telNumber" value="Tel. Number" />
                <TextInput id="telNumber" type="text" class="mt-1 block w-full" v-model="form.telNumber" required />
                <InputError class="mt-2" :message="form.errors.telNumber" />
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-between mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
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

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const toggleConfirmPassword = () => {
    showConfirmPassword.value = !showConfirmPassword.value;
};

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'patient',
    age: '',
    sex: '',
    civil_status: '',
    contact: '',
    address: '',
    occupation: '',
    officeAddress: '',
    telNumber: '',
});

const formatContactNumber = () => {
    // Ensure the contact number starts with '63' (without '+')
    form.contact = form.contact.replace(/\D/g, ''); // Remove non-numeric characters
    if (!form.contact.startsWith('63')) {
        form.contact = '63' + form.contact.replace(/^63/, '');
    }
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            Object.keys(form.errors).forEach((key) => {
                form.reset(key); // Only clears fields with errors
            });
        },
    });
};
</script>

