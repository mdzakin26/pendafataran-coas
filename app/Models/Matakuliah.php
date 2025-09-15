<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'sks'];

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
