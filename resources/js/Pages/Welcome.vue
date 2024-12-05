<template>
    <Head title="Welcome" />
    <div class="relative bg-cover bg-center bg-no-repeat before:absolute before:inset-0 before:backdrop-blur-[50px] before:bg-gradient-to-b before:from-transparent before:to-white" style="background-image: url('/images/gradientbg2.png');">    <div class="mx-auto max-w-screen-xl px-6 lg:px-8 relative">
        <div class="relative flex h-16 space-x-10 w-full">
        <div class="flex justify-start">
            <a class="flex flex-shrink-0 items-center" href="/">
                <img class="block h-8 w-auto" height="32" src="/images/dentallogo.png" >
            </a>
        </div>
        <div class="flex-shrink-0 flex px-2 py-3 items-center space-x-8 flex-1 justify-end justify-self-end ">
            <a class="text-gray-700 hover:text-blue-700 text-sm font-medium" href="login">Login</a>
            <a class="text-white bg-gray-800 hover:bg-gray-900 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm " href="register">Sign up</a>
        </div>
        </div>
    </div>
<!-- Hero Section -->
    <div class="max-w-7xl mx-auto relative mt-16 mb-16">
        <div class="relative py-16 flex justify-center px-4 sm:px-0">
            <div class="text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900">
                    <span class="block xl:inline">
                        <span class="mb-1 block">Welcome To</span>
                        <span class="bg-gradient-to-r from-indigo-400 to-pink-600 bg-clip-text text-transparent">
                            Emes da Kalinga Dental Clinic
                        </span>
                    </span>
                    <div class="mt-2 text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
                        Save Tooth for a 
                        <span class="relative whitespace-nowrap text-blue-600">
                            <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute top-3/4 left-0 right-0 m-auto h-[0.58em] w-fit fill-pink-400/50" preserveAspectRatio="none">
                                <path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path>
                            </svg>
                            <span class="relative">STRONGER and BRIGHTER</span>
                        </span>
                        Smile
                    </div>
                </h1>
                <p class="mx-auto mt-3 max-w-xl text-base sm:text-lg md:text-xl text-gray-500 dark:text-slate-400">
                    Purok 6 bulanao, 2nd floor Kub-aron building, Tabuk, Philippines, 3800
                </p>
                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center">
                    <div class="rounded-md shadow">
                        <a class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-8 py-3 text-base font-medium text-white hover:bg-blue-700 md:py-4 md:px-10 md:text-lg" :href="route('download-apk')">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3" />
                            </svg>
                            Download our App
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Feature Section -->
    <div>
    <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Check out Our Services</h2>
        <p class="mt-4 text-lg text-gray-500">Visit us today Open for <span class="underline text-blue">Walk in</span> and by <span class="underline text-blue">Appointment</span></p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-8 md:p-12 w-full p-8">
    <div class="p-6 bg-gray-100">
        <p class="text-center text-4xl">
            😁
        </p>

        <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
            Teeth Whitening <br> Oral Prophylaxis
        </h2>

        <p class="mt-2 text-gray-800 text-center">
            Flauride treatment <br> Pit and Fissure Sealant
        </p>
    </div>
    <div class="p-6 bg-gray-100">
        <p class="text-center text-4xl">
            🥰
        </p>

        <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
            Oral Surgery
        </h2>

        <p class="mt-2 text-gray-800 text-center">
            Tooth Extraction (Bunot) <br> Wisdom tooth removal 
        </p>
        <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
            Orthodontics
        </h2>

        <p class="mt-2 text-gray-800 text-center">
            Dental Braces <br> Dental Retainers 
        </p>
    </div>
    <div class="p-6 bg-gray-100">
        <p class="text-center text-4xl">
            🤩
        </p>

        <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
            Tooth Restoration
        </h2>

        <p class="mt-2 text-gray-800 text-center">
            Tooth Filling (pasta) <br> Root Canal Treatment <br> Diastema / Space Closure
        </p>
    </div>
    <div class="p-6 bg-gray-100">
        <p class="text-center text-4xl">
            😎
        </p>

        <h2 class="font-semibold text-lg text-center text-gray-800 mt-2">
            Prosthodontics
        </h2>

        <p class="mt-2 text-gray-800 text-center">
            Veneers <br> Jacket Crowns <br> Fixed Bridge <br> Complete Denture (Pustiso) <br> Partial Denture (Pustiso)
        </p>
    </div>
    </div>
</div>
    <section class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
        <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Visit Our Location</h2>
            <p class="mt-4 text-lg text-gray-500">Let us offer you the best dental care services</p>
        </div>
        <div class="mt-16 lg:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="rounded-lg overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3807.0109425738!2d121.440379574526!3d17.411262502118145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x338f9b001b519663%3A0xa5435b4c4c34a35b!2sEmes%20da%20kalinga%20dental%20clinic!5e0!3m2!1sen!2sph!4v1726676633644!5m2!1sen!2sph"
                        width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div>
                    <div class="max-w-full mx-auto rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Our Address</h3>
                            <p class="mt-1 text-gray-600">Purok 6 bulanao,2nd floor  Kub-aron building, Tabuk, Philippines, 3800</p>
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Hours</h3>
                            <p class="mt-1 text-gray-600">Monday - Friday: 9am - 5pm</p>
                            <p class="mt-1 text-gray-600">Saturday: 10am - 4pm</p>
                            <p class="mt-1 text-gray-600">Sunday: Closed</p>
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Contact</h3>
                            <p class="mt-1 text-gray-600">Email: emesdakalainga@gmail.com</p>
                            <p class="mt-1 text-gray-600">Phone: +63 966 264 2383</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section -->
<div class="text-center my-10">
    <a href="#" class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900">
        <img src="/images/dentallogo.png" class="h-12 mr-3 sm:h-9" alt="Landwind Logo">
		Emes da
    </a>

    <span class="block text-sm text-center text-gray-500 px-8">© 2024-2025. All Rights Reserved.
		In partial fulfillment for the Degree
        <a href="#"
			class="text-purple-600 hover:underline">Bachelor of Science and Technology </a>
            May
            <a
			href="#" class="text-purple-600 hover:underline">2024
        </a>.
	</span>

    <ul class="flex justify-center mt-5 space-x-5">
        <li>
            <a href="https://www.facebook.com/profile.php?id=100090379628626" class="text-gray-500 hover:text-gray-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </li>
        <li>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </li>
        <li>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                    </path>
                </svg>
            </a>
        </li>
    </ul>
</div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<style>
</style>
