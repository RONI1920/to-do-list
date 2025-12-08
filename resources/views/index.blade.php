@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title mb-4">Daftar Tugas Saya</h1>

            <form action="{{ route('task.store') }}" method="POST" class="d-flex gap-2 mb-4">
                @csrf <input type="text" name="title" class="form-control" placeholder="Mau ngerjain apa hari ini?"
                    required>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>

            <ul class="list-group">
                @forelse($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="{{ $task->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $task->title }}
                        </span>

                        <div class="d-flex gap-2">
                            <form action="{{ route('task.update', $task->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm {{ $task->is_completed ? 'btn-secondary' : 'btn-success' }}">
                                    {{ $task->is_completed ? 'Batal' : 'Selesai' }}
                                </button>
                            </form>

                            <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <div class="alert alert-info text-center">
                        Belum ada tugas. Yuk buat satu!
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
