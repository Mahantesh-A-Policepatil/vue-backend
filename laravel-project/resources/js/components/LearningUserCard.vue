<script setup>
defineProps({
  user: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="user-card">
    <div class="card-header">
      <h5 class="mb-0">{{ user.first_name }} {{ user.last_name }}</h5>
    </div>
    <div class="card-body">
      <p class="mb-2">
        <span class="badge bg-info">Age: {{ user.age }}</span>
      </p>
      <p class="text-muted small">
        ID: <strong>#{{ user.id }}</strong>
      </p>
    </div>
  </div>
</template>

<style scoped>
.user-card {
  border: 2px solid #e0e0e0;
  border-radius: 0.75rem;
  margin-bottom: 1rem;
  transition: all 0.3s ease;
  background: white;
}

.user-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  border-color: #667eea;
  transform: translateY(-2px);
}

.card-header {
  background-color: #f8f9fa;
  padding: 1rem;
  border-bottom: 2px solid #e0e0e0;
}

.card-header h5 {
  color: #333;
  font-weight: 600;
}

.card-body {
  padding: 1rem;
}

.badge {
  font-size: 0.85rem;
  padding: 0.4rem 0.8rem;
}
</style>
