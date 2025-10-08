<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  user: Object,
})
</script>

<template>
  <header
    class="fixed left-64 right-0 top-0 z-30 flex h-16 items-center justify-between bg-white border-b border-gray-200 px-6 shadow-sm"
  >
    <div>
      <h2 class="text-lg font-semibold text-gray-700">Dashboard</h2>
    </div>

    <div class="flex items-center space-x-4">
      <span class="text-gray-600">👋 {{ user.name }}</span>

      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="rounded-md bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600"
      >
        Logout
      </Link>
    </div>
  </header>
</template>
