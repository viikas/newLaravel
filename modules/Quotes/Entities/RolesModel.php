<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model {
	protected $table='roles';
    protected $fillable = ['name'];


    public function user(){

    	 return $this->hasMany('Modules\Quotes\Entities\User','role_id');

    }

}