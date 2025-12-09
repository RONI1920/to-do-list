<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // PERBAIKAN DI SINI (Hapus satu huruf 't')
            'judul_tugas' => $this->title,

            'status_task' => $this->is_completed,
            'tanggal_buat' => $this->created_at->format('d-m-Y'),
        ];
    }
}
