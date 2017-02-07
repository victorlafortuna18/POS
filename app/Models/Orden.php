<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Orden extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Orden';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idOrden'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password'];
}