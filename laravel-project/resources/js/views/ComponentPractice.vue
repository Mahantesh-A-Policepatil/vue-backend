<script setup>
import LearningUserCard from '../components/LearningUserCard.vue'

const users = [
  { id: 1, first_name: 'Mahantesh', last_name: 'Policepatil', age: 43 },
  { id: 2, first_name: 'Priyanka', last_name: 'Kumar', age: 34 },
  { id: 3, first_name: 'Ramesh', last_name: 'Patil', age: 29 }
]

const parentCode = 'import UserCard from "./UserCard.vue"\n\nconst users = [\n  { id: 1, name: "John", age: 30 },\n  { id: 2, name: "Jane", age: 28 }\n]\n\n<!-- Loop through users and send each as prop -->\n<UserCard \n  v-for="user in users" \n  :key="user.id" \n  :user="user"\n/>'

const childCode = 'defineProps({\n  user: {\n    type: Object,\n    required: true\n  }\n})\n\n<!-- Display user data -->\n<div class="user-card">\n  <h5>{{ user.first_name }} {{ user.last_name }}</h5>\n  <p>Age: {{ user.age }}</p>\n</div>'
</script>

<template>
  <div>
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-3">Day 2 - Parent-Child Communication with Props</h3>

        <div class="explanation-section mb-4">
          <h5 class="mb-2">📚 How defineProps Works</h5>
          <p class="text-muted mb-3">
            In Vue 3 with <code>&lt;script setup&gt;</code>, the child component receives data from the parent using
            <strong>defineProps</strong>.
          </p>

          <div class="code-block">
            <h6 class="mb-2">Parent Component (sends props):</h6>
            <pre><code>{{ parentCode }}</code></pre>
          </div>

          <div class="code-block mt-3">
            <h6 class="mb-2">Child Component (receives props):</h6>
            <pre><code>{{ childCode }}</code></pre>
          </div>

          <div class="alert alert-info mt-4">
            <strong>🔑 Key Points:</strong>
            <ul class="mb-0">
              <li><code>:user="user"</code> - Binds the user object as a prop to child</li>
              <li><code>v-for="user in users"</code> - Loops and renders component for each item</li>
              <li><code>defineProps()</code> - Declares which props the child accepts</li>
              <li>Props are <strong>reactive</strong> - auto-update when parent data changes</li>
            </ul>
          </div>
        </div>

        <div class="demo-section border-top pt-4">
          <h5 class="mb-3">👥 Demo: User Cards (Parent-to-Child Data Flow)</h5>
          <p class="text-muted mb-3">Each card receives user data via props:</p>
          <div class="users-grid">
            <LearningUserCard v-for="user in users" :key="user.id" :user="user" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.explanation-section {
  background-color: #f8f9fa;
  padding: 1.5rem;
  border-radius: 0.75rem;
  border-left: 4px solid #667eea;
}

.code-block {
  background-color: #2c3e50;
  color: #ecf0f1;
  padding: 1rem;
  border-radius: 0.5rem;
  overflow-x: auto;
  margin: 0.5rem 0;
}

.code-block pre {
  margin: 0;
  font-size: 0.85rem;
  line-height: 1.6;
}

.code-block code {
  font-family: 'Courier New', monospace;
  white-space: pre-wrap;
  word-wrap: break-word;
}

.demo-section {
  margin-top: 2rem;
}

.users-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-top: 1rem;
}

.alert {
  border-radius: 0.5rem;
}

.alert ul {
  padding-left: 1.5rem;
  margin-bottom: 0;
}

.alert li {
  margin-bottom: 0.75rem;
}

code {
  background-color: #f1f3f5;
  padding: 0.2rem 0.4rem;
  border-radius: 0.25rem;
  color: #d63384;
  font-family: monospace;
}

.explanation-section code {
  background-color: rgba(0, 0, 0, 0.1);
  color: #667eea;
}
</style>
