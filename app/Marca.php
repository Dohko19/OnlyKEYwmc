<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
    	'user_id', 'name', 'description', 'photo',
    ];

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $marca = static::query()->create($attributes);

        return $marca;
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
