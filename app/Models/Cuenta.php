<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Cuenta';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cuentaID', 'nombreContacto', 'correoContacto'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
}