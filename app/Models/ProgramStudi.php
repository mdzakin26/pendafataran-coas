<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_prodi', 'fakultas'];

    // TAMBAHKAN RELASI INI
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'program_studi_id');
    }
}
