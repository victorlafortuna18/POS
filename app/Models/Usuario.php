<?php

namespace SmartDelivery\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    protected $fillable = ['userID', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];


    /**
    *
    *
    */
    public function relationshipWithCuenta(){
        return $this->belongsTo('SmartDelivery\Models\Cuenta', 'cuentaID');
    }

    /**
    *
    *
    */
    public function relationshipWithRol(){
       return $this->hasOne('SmartDelivery\Models\RolUsuario', 'rolID','id');
    }
}