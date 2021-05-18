<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teachers extends Authenticatable{
    // use HasFactory;
    use Notifiable;

    protected $guard = 'teachers';
    
    protected $fillable = [
        'email', 'password',  'username', 'email', 'lastname', 
        'middlename', 'firstname', 'country_id', 'objective_title', 
        'contact_no', 'objective_text'
        // 'username', 'username', 'lastname', 'firstname', 'middlename', 'rate_per_hr', 'country_id', 'objective_title', 'objective_text'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
