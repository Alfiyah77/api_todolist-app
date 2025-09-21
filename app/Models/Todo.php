<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengguna_id',
        'judul',
        'deskripsi',
        'status',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(related: Pengguna::class);
    }
}
