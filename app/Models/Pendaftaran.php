<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftaran extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id', 'alamat', 'status', 'catatan_admin','program_studi_id','no_telepon','matakuliah_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class);
    }
    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class);
    }
    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(Matakuliah::class);
    }
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }
}
