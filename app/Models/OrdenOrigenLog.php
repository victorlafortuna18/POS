<?php

namespace SmartDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenOrigenLog extends Model
{
 // Nombre de la tabla en MySQL.
	protected $table='orden_origen_log';
 
	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('orden','ordenID');
 
	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 
}
