<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_can_be_rendered(): void
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    public function test_can_create_task_into_quadrant(): void
    {
        $response = $this->post('/tasks', [
            'title' => 'Menyelesaikan Laporan',
            'quadrant' => 1,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Menyelesaikan Laporan',
            'quadrant' => 1,
        ]);
    }
}
