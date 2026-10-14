export interface Task {
  id: number
  title: string
  description: string | null
  quadrant: number
  is_completed: boolean
  created_at: string
  updated_at: string
}

interface TasksResponse {
  status: string
  data: Task[]
}

export interface CreateTaskData {
  title: string
  description: string
  quadrant: number
}

const apiUrl = (import.meta.env.VITE_API_URL as string | undefined)?.replace(/\/$/, '')

export async function fetchTasks(): Promise<Task[]> {
  if (!apiUrl) {
    throw new Error('VITE_API_URL belum dikonfigurasi.')
  }

  const response = await fetch(`${apiUrl}/tasks`)

  if (!response.ok) {
    throw new Error(`Gagal mengambil task (${response.status}).`)
  }

  const payload = (await response.json()) as TasksResponse
  return payload.data
}

export async function createTask(task: CreateTaskData): Promise<Task> {
  if (!apiUrl) {
    throw new Error('VITE_API_URL belum dikonfigurasi.')
  }

  const response = await fetch(`${apiUrl}/tasks`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify(task),
  })

  if (!response.ok) {
    const payload = (await response.json().catch(() => null)) as { message?: string } | null
    throw new Error(payload?.message ?? `Gagal menambahkan task (${response.status}).`)
  }

  const payload = (await response.json()) as { data: Task }
  return payload.data
}