<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class PedidoUbicacion extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PedidoUbicacion';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['longitud','latitud'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
   // protected $hidden = ['password'];



    public function relationshipWithPedido(){
    	$this->belongsTo('SmartDelivery\Cliente','pedidoID');
    }
}