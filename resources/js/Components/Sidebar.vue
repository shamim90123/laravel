<script setup>
import { Link } from '@inertiajs/vue3'

const menuItems = [
  { name: 'Dashboard', route: 'dashboard', icon: 'home' },
  { name: 'Dashboard', route: 'dashboard', icon: 'home' },
//   { name: 'Users', route: 'users.index', icon: 'users' },
//   { name: 'Settings', route: 'settings', icon: 'cog' },
]
</script>

<template>
  <aside
    class="fixed left-0 top-0 z-40 h-screen w-64 bg-white border-r border-gray-200 shadow-md transition-transform sm:translate-x-0"
  >
    <div class="flex items-center justify-center h-16 border-b">
      <h1 class="text-2xl font-bold text-blue-600">Admin Panel</h1>
    </div>

    <nav class="mt-6 space-y-2 px-4">
      <Link
        v-for="item in menuItems"
        :key="item.name"
        :href="route(item.route)"
        class="flex items-center space-x-3 rounded-md px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
        :class="{ 'bg-blue-100 text-blue-600 font-semibold': route().current(item.route) }"
      >
        <i
          :class="{
            'fa-solid fa-house': item.icon === 'home',
            'fa-solid fa-users': item.icon === 'users',
            'fa-solid fa-cog': item.icon === 'cog'
          }"
          class="w-5 text-gray-500"
        ></i>
        <span>{{ item.name }}</span>
      </Link>
    </nav>
  </aside>
</template>

<style scoped>
/* for mobile toggle later */
</style>
