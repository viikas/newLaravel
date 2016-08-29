<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticable as AuthenticableTrait;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class UserModel extends Model implements Authenticatable{
	protected $table='user';
    protected $fillable = ['username','email','password','role_id','status_id','department_id'];


    //  public function roles(){

    // 	 return $this->belongsTo('Modules\Quotes\Entities\RolesModel','role_id');

    // }
    //    public function group(){

    // 	return $this->belongsToMany('Modules\Quotes\Entities\GroupModel','user_group','user_id','group_id');

    // }

//     public function getAuthPassword() {
// return $this->pwdfield_name;
// }




// public function getRememberToken()
// {
//     return $this->remember_token;
// }

// public function setRememberToken($value)
// {
//     $this->remember_token = $value;
// }

// public function getRememberTokenName()
// {
//     return 'remember_token';
// }



// public function getAuthIdentifierName(){

// return 'id';

// }




// public function getAuthIdentifier(){

// $name = $this->getAuthIdentifierName();
   
//         return $this->$name;
    
// }
}