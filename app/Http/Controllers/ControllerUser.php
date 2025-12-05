<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

// Nama class sebaiknya TaskController agar sesuai dengan fungsinya
class ControllerUser extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:125'
        ]);

        // PERBAIKAN 1: Gunakan create(), bukan created()
        Task::create([
            'title' => $request->title,
        ]);

        // PERBAIKAN 2: Perbaiki typo 'succces' menjadi 'success'
        return redirect()->route('task.index')->with('success', 'Tugas Berhasil Ditambahkan!');
    }

    public function update(Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return back()->with('success', 'Tugas sudah Selesai');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        // PERBAIKAN 3: Perbaiki typo 'succes' menjadi 'success'
        return back()->with('success', 'Tugas sudah Dihapus!');
    }
}
