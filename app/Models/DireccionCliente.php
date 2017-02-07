<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class DireccionCliente extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'DireccionCliente';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['latitud','longitud'];

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
    public function relationshipWithPais(){
        $this->hasOne('SmartDelivery\Pais', 'id', 'paisID');
    }

    /**
    *
    *
    */
    public function relationshipWithSector(){
        $this->hasOne('SmartDelivery\Sector', 'id', 'sectorID');
    }

    /**
    *
    *
    */
    public function relationshipWithCiudad(){
        $this->hasOne('SmartDelivery\Ciudad', 'id', 'ciudadID');
    }

    /**
    *
    *
    */
    public function relationshipWithProvincia(){
        $this->hasOne('SmartDelivery\Provincia', 'id', 'provinciaID');
    }
}