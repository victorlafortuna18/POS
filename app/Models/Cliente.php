<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

 	/**
     * The database table used by the model.
     *
     * @var string
     */
 	protected $table = 'Cliente';


 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 	protected $fillable = ['name', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];


    /**
    *
    *
    */
    public function relationshipWithDireccionCliente(){
    	$this->hasOne('SmartDelivery\DireccionCliente');
    }
}