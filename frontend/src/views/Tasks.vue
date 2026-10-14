<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import { createTask, fetchTasks, type Task } from '../services/taskApi'

const tasks = ref<Task[]>([])
const isLoading = ref(true)
const errorMessage = ref('')
const isSubmitting = ref(false)
const formError = ref('')
const form = ref({
  title: '',
  description: '',
  quadrant: 1,
})

async function loadTasks(): Promise<void> {
  isLoading.value = true
  errorMessage.value = ''

  try {
    tasks.value = await fetchTasks()
  } catch (error) {
    errorMessage.value = error instanceof Error ? error.message : 'Terjadi kesalahan saat memuat task.'
  } finally {
    isLoading.value = false
  }
}

async function submitTask(): Promise<void> {
  formError.value = ''
  isSubmitting.value = true

  try {
    const task = await createTask(form.value)
    tasks.value.unshift(task)
    form.value = { title: '', description: '', quadrant: 1 }
  } catch (error) {
    formError.value = error instanceof Error ? error.message : 'Task gagal ditambahkan.'
  } finally {
    isSubmitting.value = false
  }
}

function formatDate(date: string): string {
  return new Intl.DateTimeFormat('id-ID', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  }).format(new Date(date))
}

onMounted(loadTasks)
</script>

<template>
  <div class="page-shell">
    <header class="topbar">
      <RouterLink class="brand" to="/">
        
        
      </RouterLink>
      <nav class="navigation" aria-label="Navigasi utama">
        <RouterLink class="nav-link" to="/">Beranda</RouterLink>
        <RouterLink class="nav-link nav-link-active" to="/tasks">Semua task</RouterLink>
      </nav>
    </header>

    <main class="tasks-content">
      <section class="page-heading">
        <div>
          <p class="eyebrow">Task overview</p>
          <h1>Semua task</h1>
          <p class="page-description">Daftar pekerjaan yang tersimpan dari workspace Laravel.</p>
        </div>
        <div class="task-count" aria-label="Jumlah task">
          <strong>{{ tasks.length }}</strong>
          <span>total task</span>
        </div>
      </section>

      <section class="create-task-panel" aria-labelledby="create-task-title">
        <div class="create-task-heading">
          <div>
            <p class="eyebrow">Quick capture</p>
            <h2 id="create-task-title">Tambah task baru</h2>
          </div>
          <span class="form-hint">Simpan dulu, prioritaskan kemudian.</span>
        </div>

        <form class="task-form" @submit.prevent="submitTask">
          <label class="field field-title">
            <span>Judul task</span>
            <input v-model="form.title" required maxlength="255" placeholder="Contoh: Selesaikan laporan" type="text" />
          </label>
          <label class="field field-description">
            <span>Deskripsi <small>(opsional)</small></span>
            <textarea v-model="form.description" maxlength="1000" placeholder="Tambahkan konteks singkat" rows="2"></textarea>
          </label>
          <label class="field field-quadrant">
            <span>Kuadran</span>
            <select v-model.number="form.quadrant">
              <option :value="1">1 - Penting & mendesak</option>
              <option :value="2">2 - Penting</option>
              <option :value="3">3 - Mendesak</option>
              <option :value="4">4 - Nanti</option>
            </select>
          </label>
          <div class="form-actions">
            <p v-if="formError" class="form-error" role="alert">{{ formError }}</p>
            <button class="primary-button form-submit" :disabled="isSubmitting" type="submit">
              {{ isSubmitting ? 'Menyimpan...' : 'Simpan task' }}
              <span aria-hidden="true">-&gt;</span>
            </button>
          </div>
        </form>
      </section>

      <section class="task-list-panel" aria-live="polite">
        <div v-if="isLoading" class="state-message">
          <span class="loader" aria-hidden="true"></span>
          <p>Memuat task...</p>
        </div>

        <div v-else-if="errorMessage" class="state-message state-error">
          <p>{{ errorMessage }}</p>
          <button class="secondary-button" type="button" @click="loadTasks">Coba lagi</button>
        </div>

        <div v-else-if="tasks.length === 0" class="state-message">
          <p>Belum ada task di workspace ini.</p>
        </div>

        <div v-else class="task-list">
          <article v-for="task in tasks" :key="task.id" class="task-row">
            <span class="task-status" :class="{ 'task-status-done': task.is_completed }" aria-hidden="true">
              {{ task.is_completed ? '✓' : '' }}
            </span>
            <div class="task-main">
              <h2 :class="{ 'task-title-done': task.is_completed }">{{ task.title }}</h2>
              <p v-if="task.description">{{ task.description }}</p>
            </div>
            <div class="task-meta">
              <span class="quadrant-label">Kuadran {{ task.quadrant }}</span>
              <time :datetime="task.created_at">{{ formatDate(task.created_at) }}</time>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>
</template>