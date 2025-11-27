<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_kegiatan',
        'penanggung_jawab',
        'peserta',
        'biaya_pengeluaran',
    ];
    /**
     * Relasi ke SEMUA foto.
     */
    public function fotos(): HasMany
    {
        return $this->hasMany(KegiatanFoto::class);
    }

    /**
     * Relasi HANYA ke foto "Before".
     */
    public function fotosBefore(): HasMany
    {
        return $this->hasMany(KegiatanFoto::class)->where('type', 'before');
    }

    /**
     * Relasi HANYA ke foto "After".
     */
    public function fotosAfter(): HasMany
    {
        return $this->hasMany(KegiatanFoto::class)->where('type', 'after');
    }
}