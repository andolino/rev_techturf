<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Students extends Authenticatable{
    // use HasFactory;
    use Notifiable;

    protected $guard = 'students';
    
    protected $fillable = [
        'username', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    
}
