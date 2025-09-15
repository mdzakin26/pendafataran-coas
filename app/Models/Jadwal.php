<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
     protected $fillable = [
        'matakuliah_id',
        'semester',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
