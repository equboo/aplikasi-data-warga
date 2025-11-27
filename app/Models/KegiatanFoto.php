<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanFoto extends Model
{
    use HasFactory;

    protected $fillable = ['kegiatan_id', 'path', 'type'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
