<template>
  <div class="d-flex flex-column" style="min-height:100vh;">
    <Navbar />
    <div class="d-flex flex-grow-1">
      <Sidebar />
      <div class="flex-grow-1 bg-light main-content">
        <div class="container-fluid p-4">
          <router-view />
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import Sidebar from './components/Sidebar.vue'
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
</script>

<style scoped>
.main-content {
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  min-height: calc(100vh - 120px);
}
</style>
