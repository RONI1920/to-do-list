<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;

// Nama class sebaiknya TaskController agar sesuai dengan fungsinya
class ControllerUser extends Controller
{
    // menampilkan index
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('index', compact('tasks'));
    }
    // membaca data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:125'
        ]);

        // create
        Task::create([
            'title' => $request->title,
        ]);

        // PERBAIKAN 2: Perbaiki typo 'succces' menjadi 'success'
        return redirect()->route('task.index')->with('success', 'Tugas Berhasil Ditambahkan!');
    }
    // udpate
    public function update(Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        if ($task->is_completed) {
            $message = 'Tugas sudah selesai';
        } else {
            $message = 'Tugas Berhasil di Batalkan';
        }
        return back()->with('success', $message);
    }
    // Delete
    public function destroy(Task $task)
    {
        $task->delete();

        // PERBAIKAN 3: Perbaiki typo 'succes' menjadi 'success'
        return back()->with('success', 'Tugas sudah Dihapus!');
    }
}
