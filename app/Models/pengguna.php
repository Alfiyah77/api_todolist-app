<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory , Notifiable;

    protected $table ='penggunas';

    protected $fillable = [
     'nama',
        'email',
        'password',   
    ];
        

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function todos(): HasMany
    {
        return $this->hasMany(related: Todo::class);
    }
}
