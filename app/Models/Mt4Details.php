<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mt4Details extends Model
{
    use HasFactory;

    public function tuser()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
        'reminded_at' => 'datetime:Y-m-d',
    ];
}