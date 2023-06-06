<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_plans extends Model
{
    use HasFactory;

    protected $casts = [
        'activated_at' => 'datetime',
        'last_growth' => 'datetime',
        'expire_date' => 'datetime',
    ];

    public function dplan(){
        return $this->belongsTo(Plans::class, 'plan', 'id');
    }

    public function duser(){
    	return $this->belongsTo(User::class, 'user', 'id');
    }

}
