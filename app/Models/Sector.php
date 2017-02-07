<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Sector extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Sector';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nomreSector'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
}