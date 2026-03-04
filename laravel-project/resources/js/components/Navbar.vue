<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-lg px-4">
    <div class="container-fluid">
      <span class="navbar-brand fw-bold d-flex align-items-center gap-2">
        <span style="font-size: 1.5rem;">🚀</span>
        Vue CRM Learning Dashboard
      </span>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-bottom: 3px solid #42b983;
  /* reduce vertical padding to save space */
  padding-top: 0.35rem !important;
  padding-bottom: 0.35rem !important;
}

.navbar-brand {
  font-size: 1.05rem;
  letter-spacing: 0.3px;
  line-height: 1;
}

/* make emoji slightly smaller to match reduced header height */
.navbar-brand span {
  font-size: 1.25rem !important;
}
</style>
