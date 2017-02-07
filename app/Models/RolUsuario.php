<?php
namespace SmartDelivery\Models;


use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'RolUsuario';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rol'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
	
	
	public function relationshipWithUsuario()
	{
		$this->belongsTo('SmartDelivery\Models\Usuario');
	}
}