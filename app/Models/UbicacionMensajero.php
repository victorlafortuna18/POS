<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class UbicacionMensajero extends Model {

 	/**
     * The database table used by the model.
     *
     * @var string
     */
 	protected $table = 'UbicacionMensajero';


 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 	protected $fillable = [ 'user_id', 'longitude', 'latitude'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

}