<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Ronnie</title>

    {{-- INI BAGIAN PENTING AGAR BISA DICORET --}}
    <style>
        /* Mengatur tampilan seluruh halaman agar rapi */
        body {
            font-family: sans-serif;
            margin: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* INI YANG MEMBUAT EFEK CORET */
        .completed {
            text-decoration: line-through;
            /* Coret teks */
            color: gray;
            /* Warna jadi abu-abu */
            font-style: italic;
            /* Jadi miring */
        }

        /* Tambahan agar list lebih rapi */
        li {
            display: flex;
            justify-content: space-between;
            /* Jarak antara teks dan tombol */
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .actions {
            display: flex;
            gap: 10px;
            /* Jarak antar tombol */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center">Daftar Tugas Anda</h1>

        @if (session('success'))
            <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
        @endif

        {{-- FORM TAMBAH --}}
        <form method="POST" action="{{ route('task.store') }}" style="margin-bottom: 20px;">
            @csrf
            <input type="text" name="title" placeholder="Tambahkan tugas baru..." required
                style="padding: 10px; width: 70%;">
            <button type="submit" style="padding: 10px;">Tambah</button>
        </form>

        {{-- DAFTAR TUGAS --}}
        <ul>
            @forelse ($tasks as $task)
                <li>
                    {{-- Logika Class: Jika is_completed = 1, tambah class 'completed' --}}
                    <span class="{{ $task->is_completed ? 'completed' : '' }}">
                        {{ $task->title }}
                    </span>

                    <div class="actions">
                        {{-- TOMBOL SELESAI / BATALKAN --}}
                        <form method="POST" action="{{ route('task.update', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit">
                                {{ $task->is_completed ? 'Batalkan' : 'Selesai' }}
                            </button>
                        </form>

                        {{-- TOMBOL HAPUS --}}
                        <form method="POST" action="{{ route('task.destroy', $task) }}"
                            onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red;">Hapus</button>
                        </form>
                    </div>
                </li>
            @empty
                <p>Belum ada tugas! Ayo tambahkan.</p>
            @endforelse
        </ul>
    </div>
</body>

</html>
