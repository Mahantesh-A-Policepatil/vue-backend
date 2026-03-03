<script setup>
const props = defineProps({
  users: Array,
  sortKey: String,
  sortOrder: String
})

const emit = defineEmits(['deleteUser', 'editUser', 'sort'])
</script>

<template>
  <div class="table-wrapper">
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead class="table-header">
          <tr>
            <th @click="$emit('sort', 'id')" class="sortable">
              <div class="d-flex align-items-center">
                <span>#</span>
                <span v-if="sortKey === 'id'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th @click="$emit('sort', 'firstName')" class="sortable">
              <div class="d-flex align-items-center">
                <span>First Name</span>
                <span v-if="sortKey === 'firstName'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th @click="$emit('sort', 'lastName')" class="sortable">
              <div class="d-flex align-items-center">
                <span>Last Name</span>
                <span v-if="sortKey === 'lastName'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th @click="$emit('sort', 'age')" class="sortable">
              <div class="d-flex align-items-center">
                <span>Age</span>
                <span v-if="sortKey === 'age'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th @click="$emit('sort', 'department')" class="sortable">
              <div class="d-flex align-items-center">
                <span>Department</span>
                <span v-if="sortKey === 'department'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th @click="$emit('sort', 'city')" class="sortable">
              <div class="d-flex align-items-center">
                <span>City</span>
                <span v-if="sortKey === 'city'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="table-row">
            <td class="fw-bold text-primary">{{ user.id }}</td>
            <td>{{ user.firstName }}</td>
            <td>{{ user.lastName }}</td>
            <td>{{ user.age }}</td>
            <td><span class="badge bg-info">{{ user.department }}</span></td>
            <td>
              <div class="d-flex align-items-center">
                <span class="me-2">{{ user.city }}</span>
                <!-- show indicator when sorting by city -->
                <span v-if="sortKey === 'city'" class="sort-indicator" :class="sortOrder">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </td>
            <td class="text-center">
              <button class="btn btn-sm btn-outline-warning me-2" @click="$emit('editUser', user)" title="Edit user">
                ✏️ Edit
              </button>

              <button class="btn btn-sm btn-outline-danger" @click="$emit('deleteUser', user.id)" title="Delete user">
                🗑️ Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.table-wrapper {
  background: white;
  border-radius: 0.5rem;
  overflow: hidden;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

.table-responsive {
  padding: 0.6rem;
}

.table {
  margin: 0;
}

.table-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
}

.table-header th {
  border: none;
  padding: 0.45rem 0.6rem;
  font-weight: 600;
  letter-spacing: 0.4px;
  font-size: 0.92rem;
}

.sortable {
  cursor: pointer;
  user-select: none;
  transition: all 0.2s ease;
}

.sortable:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transform: scale(1.05);
}

.table-row {
  border-bottom: 1px solid #e0e0e0;
  transition: all 0.2s ease;
}

.table-row:hover {
  background-color: #f8f9ff;
}

.sort-indicator {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-left: 0.4rem;
  color: rgba(255,255,255,0.95);
}

.sort-indicator svg {
  transition: transform 0.15s ease, color 0.15s ease;
  transform-origin: center;
}

.sort-indicator.asc svg {
  transform: rotate(0deg);
}

.sort-indicator.desc svg {
  transform: rotate(180deg);
}

.table-row td {
  padding: 0.45rem 0.6rem;
  vertical-align: middle;
  font-size: 0.92rem;
}

.badge {
  padding: 0.25rem 0.5rem;
  font-size: 0.78rem;
  font-weight: 500;
  border-radius: 0.35rem;
}

.btn-outline-warning,
.btn-outline-danger {
  transition: all 0.2s ease;
  font-size: 0.85rem;
  padding: 0.25rem 0.4rem;
}

.btn-outline-warning:hover {
  background-color: #ffc107;
  border-color: #ffc107;
  color: black;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  border-color: #dc3545;
  color: white;
}
</style>
