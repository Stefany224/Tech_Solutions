<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject {
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'clave',
    ];

    protected $hidden = [
        'clave',
    ];

    // funcion para que el campo de la clave se llame clave y no password
    public function getAuthPassword() {
        return $this->clave;
    }

    // metodo para definir que valor identifica al usuario dentro del token
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    // funcion para meter datos extra dentro del token
    public function getJWTCustomClaims() {
        return [];
    }
}