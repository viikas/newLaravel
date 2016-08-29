<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model {
	protected $table='group';
    protected $fillable = ['name','created_by'];


    public function user(){
    	return $this->belongsToMany('Modules\Quotes\Entities\UserModel','user_group','group_id','user_id');



    }

}