<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import UserTable from './UserTable.vue'
import UserForm from './UserForm.vue'
import userService from '../services/userService.js'  // API client

/* ---------------- FILTER STATE ---------------- */
const filterType = ref('')
const filterValue = ref('')
const search = ref('')

/* store server-provided options for dropdowns */
const allFilterOptions = ref({ department: [], city: [] })

/* ---------------- USERS DATA ---------------- */
const users = ref([])
const totalPages = ref(0)

// default page size; can be made configurable
const perPage = 5
const currentPage = ref(1)

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


// helper for loading from backend
function loadUsers() {
  const params = {
    page: currentPage.value,
    perPage,
    search: search.value,
    filterType: filterType.value,
    filterValue: filterValue.value,
    sortKey: sortKey.value,
    sortOrder: sortOrder.value,
  }

  userService.getUsers(params)
    .then(res => {
      users.value = res.data.data || []
      totalPages.value = res.data.last_page || 0
    })
    .catch(err => {
      console.error('Failed to fetch users', err)
    })
}

// load options for filter dropdowns as needed
function loadFilterOptions() {
  userService.getFilterOptions()
    .then(opts => {
      allFilterOptions.value = opts
    })
    .catch(err => console.error('Failed to load filter options', err))
}

// run initial load
onMounted(() => {
  loadUsers()
  loadFilterOptions()
});

/* ---------------- FORM STATE ---------------- */
const editingUser = ref(null)
const showForm = ref(false)

/* ---------------- FILTER OPTIONS ---------------- */
const filterOptions = computed(() => {
  if (!filterType.value) return []
  return allFilterOptions.value[filterType.value] || []
})

/* Reset pagination and reload when filters or sort change */
watch([filterType, filterValue, sortKey, sortOrder], () => {
  currentPage.value = 1
  loadUsers()
  if (filterType.value) {
    loadFilterOptions()
  }
})

/* reload when page changes */
watch(currentPage, loadUsers)

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
          <h5 class="mb-0 fw-bold">👥 User Management</h5>
          <button class="btn btn-success btn-sm px-3" @click="openCreate">
            ➕ Add User
          </button>
        </div>
      </div>

      <div class="row g-3 align-items-end">
        <!-- Search -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">🔍 Search</label>
          <div class="input-group">
            <input v-model="searchInput" class="form-control" placeholder="Search users..." />
            <button class="btn btn-outline-secondary" type="button" @click="performSearch">Search</button>
            <button v-if="searchInput" class="btn btn-outline-danger" type="button" @click="clearSearch">✖</button>
          </div>
        </div>

        <!-- Filter Type -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">Filter By</label>
          <select v-model="filterType" class="form-select">
            <option value="">Select Filter Type</option>
            <option value="department">Department</option>
            <option value="city">City</option>
          </select>
        </div>

        <!-- Filter Value -->
        <div class="col-md-4">
          <label class="form-label fw-bold text-muted">Select Value</label>
          <select v-model="filterValue" class="form-select" :disabled="!filterType">
            <option value="">Select Value</option>
            <option v-for="option in filterOptions" :key="option" :value="option">
              {{ option }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <!-- ================= TABLE ================= -->
    <UserTable
      :users="users"
      :sortKey="sortKey"
      :sortOrder="sortOrder"
      @sort="sortBy"
      @deleteUser="deleteUser"
      @editUser="openEdit"
    />

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
  padding: 1rem;
  border-radius: 0.6rem;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

.form-label {
  font-size: 0.85rem;
  color: #666;
}

.form-control,
.form-select {
  border-radius: 0.4rem;
  border: 1.5px solid #e0e0e0;
  transition: all 0.2s ease;
  padding: 0.35rem 0.5rem;
  font-size: 0.92rem;
}

.form-control:focus,
.form-select:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.18);
}

.btn-success {
  background-color: #42b983;
  border-color: #42b983;
  font-size: 0.9rem;
  padding: 0.35rem 0.6rem;
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
