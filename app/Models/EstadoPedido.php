<?php

namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'EstadoPedido';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['estadoPedido'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
}