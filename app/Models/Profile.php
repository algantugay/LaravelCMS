<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'name',
        'surname',
        'email',
        'phone',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
