<template>
    <section class="max-w-full">
      <header>
        <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
        <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>
      </header>
  
      <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Name -->
          <div class="col-span-1">
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
          <div class="col-span-1">
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
  
          <!-- Age -->
          <div class="col-span-1">
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
          <div class="col-span-1">
            <InputLabel for="sex" value="Sex" />
            <TextInput
              id="sex"
              type="text"
              class="mt-1 block w-full"
              v-model="form.sex"
              required
            />
            <InputError class="mt-2" :message="form.errors.sex" />
          </div>
  
          <!-- Civil Status -->
          <div class="col-span-1">
            <InputLabel for="civil_status" value="Civil Status" />
            <TextInput
              id="civil_status"
              type="text"
              class="mt-1 block w-full"
              v-model="form.civil_status"
              required
            />
            <InputError class="mt-2" :message="form.errors.civil_status" />
          </div>
  
          <!-- Course Year -->
          <div class="col-span-1">
            <InputLabel for="course_year" value="Course Year" />
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
          <div class="col-span-1">
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
          <div class="col-span-1">
            <InputLabel for="position" value="Position" />
            <TextInput
              id="position"
              type="text"
              class="mt-1 block w-full"
              v-model="form.position"
              required
            />
            <InputError class="mt-2" :message="form.errors.position" />
          </div>
  
          <!-- Address -->
          <div class="col-span-1">
            <InputLabel for="address" value="Address" />
            <TextInput
              id="address"
              type="text"
              class="mt-1 block w-full"
              v-model="form.address"
              required
            />
            <InputError class="mt-2" :message="form.errors.address" />
          </div>
  
          <!-- In Case of Emergency: Name -->
          <div class="col-span-1">
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
  
          <!-- In Case of Emergency: Relation -->
          <div class="col-span-1">
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
  
          <!-- In Case of Emergency: Address -->
          <div class="col-span-1">
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
  
          <!-- In Case of Emergency: Contact -->
          <div class="col-span-1">
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
        </div>
  
        <!-- Save Button -->
        <div class="flex items-center gap-4">
          <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
  
          <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
          >
            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
          </Transition>
        </div>
      </form>
    </section>
  </template>
  Script
  <script setup>
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Link, useForm, usePage } from '@inertiajs/vue3';
  
  defineProps({
    mustVerifyEmail: {
      type: Boolean,
    },
    status: {
      type: String,
    },
  });
  
  const user = usePage().props.auth.user;
  
  const form = useForm({
    name: user.name,
    email: user.email,
    age: user.age, // Add the additional fields here
    sex: user.sex,
    civil_status: user.civil_status,
    course_year: user.course_year,
    contact: user.contact,
    position: user.position,
    address: user.address,
    ioe_name: user.ioe_name,
    ioe_relation: user.ioe_relation,
    ioe_address: user.ioe_address,
    ioe_contact: user.ioe_contact,
  });
  </script>