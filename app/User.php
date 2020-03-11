<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function marcas()
    {
        return $this->hasMany(Marca::class);
    }

    public function grupos()
    {
        return $this->hasMany(GrupoMarca::class);
    }

    public function segmentos()
    {
        return $this->hasMany(Segmento::class);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('id', auth()->id());
    }

    // public function auditorias()
    // {
    //     return $this->belongsToMany(Auditoria::class, 'auditoria_user', 'auditoria_id', 'user_id');
    // }

    // public function syncAuditors($tags)
    // {
    //     $tagIds = collect($tags)->map(function($tag){
    //         return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
    //     });
    //     return $this->tags()->sync($tagIds);
    // }
    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('display_name')->implode(', ');
    }

    public function sucursals()
    {
        return $this->belongsToMany(Sucursal::class);
    }
}
