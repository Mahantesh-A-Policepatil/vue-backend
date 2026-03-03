<script setup>
const props = defineProps({
  id: Number,
  firstName: String,
  lastName: String,
  age: Number
})

const emit = defineEmits(['deleteUser'])

function handleDelete() {
  emit('deleteUser', props.id)
}
</script>

<template>
  <div class="user-card">
    <div class="card-header">
      <span class="badge">ID: {{ id }}</span>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ firstName }} {{ lastName }}</h5>
      <p class="card-text">
        <strong>Age:</strong> {{ age }} years old
      </p>
    </div>
    <div class="card-footer">
      <button @click="handleDelete" class="btn btn-sm btn-danger w-100">
        🗑️ Delete User
      </button>
    </div>
  </div>
</template>

<style scoped>
.user-card {
  border: none;
  border-radius: 0.75rem;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  background: white;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.user-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 1rem;
  color: white;
}

.badge {
  background-color: rgba(255, 255, 255, 0.3);
  padding: 0.35rem 0.65rem;
  border-radius: 0.35rem;
}

.card-body {
  padding: 1rem;
  flex-grow: 1;
}

.card-title {
  color: #2c3e50;
  margin-bottom: 0.75rem;
  font-weight: 600;
}

.card-text {
  color: #555;
  font-size: 0.95rem;
  margin: 0;
}

.card-footer {
  padding: 1rem;
  border-top: 1px solid #eee;
  background-color: #f9f9f9;
}
</style>
