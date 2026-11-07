<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';

    protected $fillable = [
        'nama_guru',
        'mapel'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
