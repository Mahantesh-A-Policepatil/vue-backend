<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import UserTable from './UserTable.vue'
import UserForm from './UserForm.vue'
import userService from '../services/userService.js'  // API client

/* ---------------- FILTER STATE ---------------- */
const filterType = ref('')
const filterValue = ref('')
const search = ref('')

/* ---------------- USERS DATA ---------------- */
const users = ref([])

// helper for loading from backend
function loadUsers() {
  userService.getUsers()
    .then(res => {
      users.value = res.data
    })
    .catch(err => {
      console.error('Failed to fetch users', err)
    })
}

// run initial load
onMounted(loadUsers);

/* ---------------- SORT ---------------- */
const sortKey = ref('')
const sortOrder = ref('asc') // asc or desc

function sortBy(column) {
  if (sortKey.value === column) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortKey.value = column
    sortOrder.value = 'asc'
  }
}


/* ---------------- PAGINATION ---------------- */
const currentPage = ref(1)
const perPage = 5

/* ---------------- FORM STATE ---------------- */
const editingUser = ref(null)
const showForm = ref(false)

/* ---------------- FILTER OPTIONS ---------------- */
const filterOptions = computed(() => {
  if (!filterType.value) return []
  return [...new Set(users.value.map(user => user[filterType.value]))]
})

/* ---------------- FILTER + SEARCH ---------------- */
const filteredUsers = computed(() => {
  const keyword = search.value.toLowerCase()

  return users.value.filter(user => {

    // Global Search
    const matchesSearch = Object.values(user).some(value =>
      value.toString().toLowerCase().includes(keyword)
    )

    // Dropdown Filter
    const matchesFilter =
      !filterType.value ||
      !filterValue.value ||
      user[filterType.value] === filterValue.value

    return matchesSearch && matchesFilter
  })
})

/* Reset page when search/filter changes */
watch([search, filterType, filterValue], () => {
  currentPage.value = 1
})

/* ---------------- PAGINATION LOGIC ---------------- */
const totalPages = computed(() =>
  Math.ceil(filteredUsers.value.length / perPage)
)

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return sortedUsers.value.slice(start, start + perPage)
})

const sortedUsers = computed(() => {
  if (!sortKey.value) return filteredUsers.value

  return [...filteredUsers.value].sort((a, b) => {
    let valueA = a[sortKey.value]
    let valueB = b[sortKey.value]

    if (typeof valueA === 'string') {
      valueA = valueA.toLowerCase()
      valueB = valueB.toLowerCase()
    }

    if (valueA < valueB) return sortOrder.value === 'asc' ? -1 : 1
    if (valueA > valueB) return sortOrder.value === 'asc' ? 1 : -1
    return 0
  })
})

/* ---------------- CRUD ---------------- */
function deleteUser(id) {
  userService.deleteUser(id)
    .then(() => loadUsers())
    .catch(err => console.error('Delete failed', err))
}

function openCreate() {
  editingUser.value = null
  showForm.value = true
}

function openEdit(user) {
  editingUser.value = { ...user }
  showForm.value = true
}

function saveUser(userData) {
  if (userData.id) {
    userService.updateUser(userData.id, userData)
      .then(() => loadUsers())
      .catch(err => console.error('Update failed', err))
  } else {
    userService.createUser(userData)
      .then(() => loadUsers())
      .catch(err => console.error('Create failed', err))
  }
  showForm.value = false
}
</script>

<template>
  <div>
    <!-- ================= TOP CONTROLS ================= -->
    <div class="controls-section mb-4">
      <div class="row g-3 mb-3">
        <!-- Add User Button -->
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h4 class="mb-0 fw-bold">👥 User Management</h4>
          <button class="btn btn-success btn-lg px-4" @click="openCreate">
            ➕ Add User
          </button>
        </div>
      </div>

      <div class="row g-3 align-items-end">
        <!-- Search -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">🔍 Search</label>
          <input v-model="search" class="form-control form-control-lg" placeholder="Search users..." />
        </div>

        <!-- Filter Type -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">Filter By</label>
          <select v-model="filterType" class="form-select form-select-lg">
            <option value="">Select Filter Type</option>
            <option value="department">Department</option>
            <option value="city">City</option>
          </select>
        </div>

        <!-- Filter Value -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">Select Value</label>
          <select v-model="filterValue" class="form-select form-select-lg" :disabled="!filterType">
            <option value="">Select Value</option>
            <option v-for="option in filterOptions" :key="option" :value="option">
              {{ option }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <!-- ================= TABLE ================= -->
    <UserTable :users="paginatedUsers" @deleteUser="deleteUser" @editUser="openEdit" />

    <!-- ================= PAGINATION ================= -->
    <nav class="mt-4" v-if="totalPages > 1">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="currentPage = Math.max(1, currentPage - 1)" :disabled="currentPage === 1">
            Previous
          </button>
        </li>
        <li class="page-item" :class="{ active: currentPage === page }" v-for="page in totalPages" :key="page">
          <button class="page-link" @click="currentPage = page">
            {{ page }}
          </button>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <button class="page-link" @click="currentPage = Math.min(totalPages, currentPage + 1)"
            :disabled="currentPage === totalPages">
            Next
          </button>
        </li>
      </ul>
    </nav>

    <!-- ================= MODAL ================= -->
    <UserForm v-if="showForm" :user="editingUser" @save="saveUser" @close="showForm = false" />
  </div>
</template>

<style scoped>
.controls-section {
  background: white;
  padding: 1.5rem;
  border-radius: 0.75rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.form-label {
  font-size: 0.9rem;
  color: #666;
}

.form-control,
.form-select {
  border-radius: 0.5rem;
  border: 2px solid #e0e0e0;
  transition: all 0.3s ease;
}

.form-control:focus,
.form-select:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-success {
  background-color: #42b983;
  border-color: #42b983;
}

.btn-success:hover {
  background-color: #38a372;
  border-color: #38a372;
}

.pagination {
  gap: 0.5rem;
}

.page-item .page-link {
  border-radius: 0.5rem;
  border: 2px solid #e0e0e0;
  color: #667eea;
  transition: all 0.2s ease;
}

.page-item .page-link:hover:not(.disabled) {
  background-color: #667eea;
  color: white;
  border-color: #667eea;
  transform: scale(1.05);
}

.page-item.active .page-link {
  background-color: #667eea;
  border-color: #667eea;
  color: white;
}

.page-item.disabled .page-link {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
