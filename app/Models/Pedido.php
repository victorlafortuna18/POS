<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Pedido';


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



    public function relationshipWithCliente(){
    	$this->belongsTo('SmartDelivery\Cliente','clienteID');
    }

    public function relationshipWithUsuario(){
    	$this->hasOne('SmartDelivery\Usuario','usuarioID');
    }

    public function relationshipWithEstadoPedido(){
    	$this->hasOne('SmartDelivery\EstadoPedido','estadoPedidoID');
    }
}