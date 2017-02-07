<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Pais extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Pais';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombrePais'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
}