<?php

namespace SmartDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenOrigenTXT extends Model
{
 // Nombre de la tabla en MySQL.
	protected $table='orden_origen_txt';
 
	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('ordenid','tipo_iden','identificacion','cliente','telefono','mail','sucursalid','subtotal','impuesto','total','ciudad','pais','direccion','cuentaid');
 
	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 
}
