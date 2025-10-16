<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Iuran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Mendefinisikan relasi bahwa satu Iuran dimiliki oleh satu Warga.
     */
    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }
}