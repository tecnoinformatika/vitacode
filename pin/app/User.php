<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function Order()
    {
        return $this->hasMany('App\Order');
    }
    
    public function ficha()
    {
        return $this->hasOne('App\Ficha');
    }
    public function Contacto()
    {
        return $this->hasMany('App\Contacto');
    }
    
    public function Enfermedad()
    {
        return $this->hasMany('App\Enfermedad');
    }
    public function Remedio()
    {
        return $this->hasMany('App\Remedios');
    }
    public function Coordenada()
    {
        return $this->hasMany('App\Coordenada');
    }
    
    public function Id()
    {
        return $this->hasMany('App\Id');
    }
}
