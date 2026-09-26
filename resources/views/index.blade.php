<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eisenhower Matrix To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Aplikasi To-Do List (Four Quadrants)</h1>

        <!-- Form Tambah Tugas -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-6 flex gap-4">
            @csrf
            <input type="text" name="title" placeholder="Judul tugas..." required class="border p-2 rounded flex-1">
            <select name="quadrant" class="border p-2 rounded">
                <option value="1">Kuadran 1: Important & Urgent</option>
                <option value="2">Kuadran 2: Important & Not Urgent</option>
                <option value="3">Kuadran 3: Not Important & Urgent</option>
                <option value="4">Kuadran 4: Not Important & Not Urgent</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
        </form>

        <!-- Daftar Tugas -->
        <ul>
            @foreach($tasks as $task)
                <li class="border-b py-2 flex justify-between items-center">
                    <span>{{ $task->title }} (Kuadran {{ $task->quadrant }})</span>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>