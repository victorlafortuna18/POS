<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Localidad extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Localidad';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
}