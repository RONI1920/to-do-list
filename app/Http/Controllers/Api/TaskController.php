<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task; // Pastikan Model Task di-import (sesuaikan jika nama model Anda 'Todo')

class TaskController extends Controller
{
    // INI FUNGSI YANG HILANG (Penyebab Error)
    public function index()
    {
        // Pastikan Anda sudah punya Model 'Task'. 
        // Jika nama model Anda 'Todo', ganti 'Task' jadi 'Todo'.
        $tasks = Task::all();

        return response()->json([
            'status' => true,
            'message' => 'Daftar semua task',
            'data' => $tasks
        ], 200);
    }

    // Fungsi untuk tambah data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:125'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422); // 422 = Unprocessable Entity
        }

        $task = Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Task berhasil ditambahkan',
            'data' => $task
        ], 201);
    }

    // Fungsi untuk update
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $task->update($request->all());

        return response()->json(['message' => 'Task berhasil diupdate', 'data' => $task], 200);
    }

    // Fungsi untuk hapus
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task berhasil dihapus'], 200);
    }
}
