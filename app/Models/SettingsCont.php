<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsCont extends Model
{
    use HasFactory;

    protected $casts = [
        'use_transfer' => 'boolean',
    ];
}
