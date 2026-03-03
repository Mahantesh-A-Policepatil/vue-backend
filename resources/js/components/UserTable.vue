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
              #
            </th>
            <th @click="$emit('sort', 'firstName')" class="sortable">
              First Name
            </th>
            <th @click="$emit('sort', 'lastName')" class="sortable">
              Last Name
            </th>
            <th @click="$emit('sort', 'age')" class="sortable">
              Age
            </th>
            <th @click="$emit('sort', 'department')" class="sortable">
              Department
            </th>
            <th @click="$emit('sort', 'city')" class="sortable">
              City
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
            <td><span class="badge bg-secondary">{{ user.city }}</span></td>
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
  border-radius: 0.75rem;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.table-responsive {
  padding: 1.5rem;
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
  padding: 1rem;
  font-weight: 600;
  letter-spacing: 0.5px;
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

.table-row td {
  padding: 1rem;
  vertical-align: middle;
}

.badge {
  padding: 0.5rem 0.75rem;
  font-size: 0.85rem;
  font-weight: 500;
  border-radius: 0.35rem;
}

.btn-outline-warning,
.btn-outline-danger {
  transition: all 0.3s ease;
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
