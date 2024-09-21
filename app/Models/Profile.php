<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'gender',
        'marital_status',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
