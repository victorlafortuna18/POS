<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Provincia extends Model {

 	/**
     * The database table used by the model.
     *
     * @var string
     */
 	protected $table = 'Provincia';


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
    public function relationshipWithSector(){
    	$this->belongsTo('SmartDelivery\Sector');
    }
}