<script setup>
import { ref } from 'vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// Password visibility toggle
const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout class="rounded-xl">
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <!-- Centering the logo -->
        <div class="flex justify-center mb-8">
            <Link href="/"> 
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full border border-gray-300"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

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
                    name="password"
                    id="password"
                    class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400 pr-12"
                    v-model="form.password"
                    placeholder="***********"
                    />

                    <!-- Eye Icon Button -->
                    <button
                    type="button"
                    class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 border-l border-gray-300"
                    @click="togglePassword"
                    >
                    <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'" class="text-lg"></i>
                    </button>
                </div>
            </div>
            </div>


            <div class="block mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('register')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Don't Have An Account?<span class="text-purple-700 font-bold"> Click Here!</span>
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
