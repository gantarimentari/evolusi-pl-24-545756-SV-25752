import { afterEach, describe, expect, it, vi } from 'vitest'
import { fetchTasks } from './taskApi'

describe('fetchTasks', () => {
  afterEach(() => {
    vi.restoreAllMocks()
  })

  it('returns tasks from the Laravel API response', async () => {
    const tasks = [
      {
        id: 1,
        title: 'Tugas pertama',
        description: null,
        quadrant: 1,
        is_completed: false,
        created_at: '2026-10-15T00:00:00.000000Z',
        updated_at: '2026-10-15T00:00:00.000000Z',
      },
    ]

    vi.stubGlobal(
      'fetch',
      vi.fn().mockResolvedValue(
        new Response(JSON.stringify({ status: 'success', data: tasks }), {
          status: 200,
          headers: { 'Content-Type': 'application/json' },
        }),
      ),
    )

    await expect(fetchTasks()).resolves.toEqual(tasks)
    expect(fetch).toHaveBeenCalledWith('http://127.0.0.1:8000/api/tasks')
  })
})
