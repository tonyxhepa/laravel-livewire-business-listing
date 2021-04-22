<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
        'address',
        'website',
        'email',
        'phone',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
