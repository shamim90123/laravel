<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="p-6 bg-white shadow rounded-lg">
        <h3 class="text-gray-500">Users</h3>
        <p class="text-3xl font-bold text-blue-600">150</p>
      </div>
      <div class="p-6 bg-white shadow rounded-lg">
        <h3 class="text-gray-500">Applications</h3>
        <p class="text-3xl font-bold text-green-600">32</p>
      </div>
      <div class="p-6 bg-white shadow rounded-lg">
        <h3 class="text-gray-500">Revenue</h3>
        <p class="text-3xl font-bold text-yellow-600">$12,400</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
