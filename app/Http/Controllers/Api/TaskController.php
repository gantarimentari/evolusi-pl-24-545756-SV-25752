<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => Task::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'quadrant' => ['required', 'integer', 'between:1,4'],
            'is_completed' => ['sometimes', 'boolean'],
        ]);

        $task = Task::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Task berhasil ditambahkan.',
            'data' => $task,
        ], 201);
    }
}
