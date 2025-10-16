<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Tambahkan ini

class Warga extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Mendefinisikan relasi bahwa satu Warga memiliki banyak Iuran.
     */
    public function iurans(): HasMany
    {
        return $this->hasMany(Iuran::class);
    }
}