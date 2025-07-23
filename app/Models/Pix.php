<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pix extends Model
{
    use HasFactory;

    protected $table = 'pix';

    protected $fillable = [
        'user_id',
        'token',
        'status',
        'expires_at',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
