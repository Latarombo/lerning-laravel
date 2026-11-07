<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_siswa' => $this->nama_siswa,
            'bb' => $this->bb,
            'tb' => $this->tb,
            'kelas_id' => $this->kelas_id,
            'kelas' => new KelasResource($this->whenLoaded('kelas')),
        ];
    }
}
