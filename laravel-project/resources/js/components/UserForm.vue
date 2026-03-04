<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  user: Object
})

const emit = defineEmits(['save', 'close'])

const form = ref({
  id: null,
  firstName: '',
  lastName: '',
  age: '',
  department: '',
  city: ''
})

/* Populate form when editing */
watch(
  () => props.user,
  (newVal) => {
    if (newVal) {
      form.value = { ...newVal }
    } else {
      form.value = {
        id: null,
        firstName: '',
        lastName: '',
        age: '',
        department: '',
        city: ''
      }
    }
  },
  { immediate: true }
)

function submitForm() {
  emit('save', { ...form.value })
}
</script>

<template>
  <div class="modal-overlay" @click.self="$emit('close')">
    <div class="modal-container">
      <div class="form-modal">
        <!-- Modal Header -->
        <div class="modal-header">
          <div class="header-content">
            <h5 class="modal-title fw-bold">
              {{ form.id ? '✏️ Edit User' : '➕ Add New User' }}
            </h5>
            <p class="header-subtitle">{{ form.id ? 'Update user information' : 'Create a new user account' }}</p>
          </div>
          <button type="button" class="close-btn" @click="$emit('close')">
            <span>✕</span>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <!-- First Row: Names -->
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">
                <span class="label-icon">👤</span>
                First Name
              </label>
              <input v-model="form.firstName" type="text" class="form-control" placeholder="Enter first name"
                @focus="$event.target.parentElement.classList.add('focused')"
                @blur="$event.target.parentElement.classList.remove('focused')" />
            </div>

            <div class="form-group">
              <label class="form-label">
                <span class="label-icon">👤</span>
                Last Name
              </label>
              <input v-model="form.lastName" type="text" class="form-control" placeholder="Enter last name"
                @focus="$event.target.parentElement.classList.add('focused')"
                @blur="$event.target.parentElement.classList.remove('focused')" />
            </div>
          </div>

          <!-- Age Field -->
          <div class="form-group">
            <label class="form-label">
              <span class="label-icon">🎂</span>
              Age
            </label>
            <input v-model="form.age" type="number" class="form-control" placeholder="Enter age"
              @focus="$event.target.parentElement.classList.add('focused')"
              @blur="$event.target.parentElement.classList.remove('focused')" />
          </div>

          <!-- Department Field -->
          <div class="form-group">
            <label class="form-label">
              <span class="label-icon">💼</span>
              Department
            </label>
            <select v-model="form.department" class="form-select"
              @focus="$event.target.parentElement.classList.add('focused')"
              @blur="$event.target.parentElement.classList.remove('focused')">
              <option value="">Select Department</option>
              <option>IT</option>
              <option>HR</option>
              <option>Finance</option>
              <option>Marketing</option>
            </select>
          </div>

          <!-- City Field -->
          <div class="form-group">
            <label class="form-label">
              <span class="label-icon">🏙️</span>
              City
            </label>
            <select v-model="form.city" class="form-select"
              @focus="$event.target.parentElement.classList.add('focused')"
              @blur="$event.target.parentElement.classList.remove('focused')">
              <option value="">Select City</option>
              <option>Belgaum</option>
              <option>Mumbai</option>
              <option>Delhi</option>
              <option>Pune</option>
              <option>Bangalore</option>
            </select>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-cancel" @click="$emit('close')">
            ✕ Cancel
          </button>
          <button type="button" class="btn btn-submit" @click="submitForm">
            {{ form.id ? '💾 Update' : '➕ Create' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

.modal-container {
  width: 90%;
  max-width: 500px;
  animation: slideUp 0.3s ease;
}

@keyframes slideUp {
  from {
    transform: translateY(30px);
    opacity: 0;
  }

  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.form-modal {
  background: white;
  border: none;
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 2rem;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
}

.header-content {
  flex: 1;
}

.modal-title {
  color: white;
  font-size: 1.5rem;
  margin: 0;
  margin-bottom: 0.5rem;
}

.header-subtitle {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.9rem;
  margin: 0;
}

.close-btn {
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid rgba(255, 255, 255, 0.3);
  color: white;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}

.close-btn:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: rotate(90deg);
}

.modal-body {
  padding: 2rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group:last-child {
  margin-bottom: 0;
}

.form-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #2c3e50;
  font-weight: 600;
  font-size: 0.95rem;
  margin-bottom: 0.75rem;
}

.label-icon {
  font-size: 1.1rem;
}

.form-control,
.form-select {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 2px solid #e8e8f0;
  border-radius: 0.75rem;
  font-size: 0.95rem;
  font-family: inherit;
  transition: all 0.3s ease;
  background-color: #f8f9ff;
}

.form-control::placeholder {
  color: #adb5bd;
}

.form-control:hover,
.form-select:hover {
  border-color: #667eea;
  background-color: white;
}

.form-control:focus,
.form-select:focus {
  outline: none;
  border-color: #667eea;
  background-color: white;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group.focused .form-control,
.form-group.focused .form-select {
  border-color: #667eea;
  background-color: white;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.modal-footer {
  padding: 1.5rem 2rem;
  background-color: #f8f9ff;
  border-top: 1px solid #e8e8f0;
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
}

.btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-cancel {
  background-color: #e8e8f0;
  color: #2c3e50;
}

.btn-cancel:hover {
  background-color: #d0d0e0;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-submit {
  background: linear-gradient(135deg, #42b983 0%, #38a372 100%);
  color: white;
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(66, 185, 131, 0.4);
}

.btn-submit:active {
  transform: translateY(0);
}

@media (max-width: 600px) {
  .form-row {
    grid-template-columns: 1fr;
  }

  .modal-container {
    width: 95%;
  }

  .modal-header {
    padding: 1.5rem;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .modal-footer {
    padding: 1.5rem;
    flex-direction: column-reverse;
  }

  .btn {
    width: 100%;
    justify-content: center;
  }
}
</style>
