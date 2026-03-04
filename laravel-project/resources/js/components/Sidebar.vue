<template>
  <div class="sidebar text-white p-4" style="width:250px;">
    <h4 class="text-center mb-4 fw-bold">📚 Vue Learning</h4>

    <ul class="nav nav-pills flex-column gap-2">

      <li class="nav-item">
        <router-link to="/basics" class="nav-link text-white rounded-lg px-3 py-2">
          📖 Day-1 Basics
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/components" class="nav-link text-white rounded-lg px-3 py-2">
          🧩 Day-2 Components
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/forms" class="nav-link text-white rounded-lg px-3 py-2">
          📝 Day-3 Forms
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/users" class="nav-link text-white rounded-lg px-3 py-2">
          👥 Day-4 Users
        </router-link>
      </li>

    </ul>
  </div>
</template>

<style scoped>
.sidebar {
  background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
  border-right: 4px solid #42b983;
  box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
}

.nav-link {
  transition: all 0.3s ease;
  border-left: 4px solid transparent;
  padding-left: 1rem !important;
}

.nav-link:hover {
  background-color: rgba(66, 185, 131, 0.2) !important;
  border-left-color: #42b983;
  transform: translateX(5px);
}

.router-link-active {
  background-color: #42b983 !important;
  border-left-color: #fff !important;
  box-shadow: 0 4px 12px rgba(66, 185, 131, 0.3);
}

.rounded-lg {
  border-radius: 0.5rem;
}
</style>
