<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    use HasFactory;

    public static function search($search): \Illuminate\Database\Eloquent\Builder
    {
        return empty($search) ? static::query()
        : static::query()->where('nickname', 'like', '%'.$search.'%');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function duser(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected $cast = [
        'payment_methods' => 'array',
    ];
	
}
