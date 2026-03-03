<script setup>
import { ref } from 'vue'

const count = ref(0)
const increment = () => count.value++
</script>

<template>
  <div>
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-3">Day 1 - Vue Basics</h3>
        <p class="text-muted">
          Here we practice:
        </p>

        <ul class="list-group mb-4">
          <li class="list-group-item">v-bind</li>
          <li class="list-group-item">v-if / v-show</li>
          <li class="list-group-item">v-for</li>
          <li class="list-group-item">Events</li>
        </ul>

        <!-- Counter Example -->
        <div class="border-top pt-4">
          <h5 class="mb-3">📊 Counter Example</h5>
          <p class="text-muted">Current count: <strong class="text-primary">{{ count }}</strong></p>
          <button @click="increment" class="btn btn-primary btn-lg">
            Click Me
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.btn-lg {
  padding: 0.75rem 2rem;
  font-size: 1.1rem;
}
</style>
