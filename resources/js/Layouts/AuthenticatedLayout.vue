<script setup>
import Sidebar from '@/Components/Sidebar.vue'
import Navbar from '@/Components/Navbar.vue'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()
</script>

<template>
  <div class="flex bg-gray-100">
    <!-- Sidebar -->
    <Sidebar />

    <!-- Main content -->
    <div class="flex-1 ml-64">
      <!-- Navbar -->
      <Navbar :user="props.auth.user" />

      <!-- Main Page -->
      <main class="mt-16 p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
