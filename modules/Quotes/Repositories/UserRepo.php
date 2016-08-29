<?php

namespace Modules\Quotes\Repositories;

use Validator;
use Modules\Quotes\Repositories\Common\Common;
use DB;
use Hash;

use Modules\Quotes\Entities\User;
use Illuminate\Support\Facades\Input;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Role;
use App\Permission;
class UserRepo implements UserInterface {


	public function getPermission(){

		$permission=Permission::get();

	return $permission;

			}

	public function getRoles(){

		$role=Role::with('permissions')->get();

	return $role;

			}


	public function addNewRole($data){
		// dd($data);
		
		$permissions=Input::get('permission_id');
		$role=new Role(
			[
			'name'=>$data->name,
			'display_name'=>$data->display_name,
			'description'=>$data->description
			]
			);
		$role->save();
		if(!empty($permissions)){
 				foreach($permissions as $permission)
 					$role->permissions()->attach($permission);
 			}
 			
		return Common::getJsonResponse(true, 'new Role created successfully!', 200);
	}		
 

 	public function editRoles($data){
 	$permissions=Input::get('permission_id');	
 	$role=Role::findorFail($data->id);
 	$role->name=$data->name;
 	$role->display_name=$data->display_name;
 	$role->description=$data->description;

 	$role->save();

 	$rolepermission=[];
 			if(!empty($permissions)){
 				foreach($permissions as $permission){
 					$rolepermission[$permission]=$permission;
 				}
 						
 					$role->permissions()->sync($rolepermission);
 			}


 	 return Common::getJsonResponse(true, ' role updated successfully !', 200);

 	}


 	


 	public function getUsers(){
 		$data=User::with('roles')->get();
 		return $data;

 	}


 	public function addUser($data){
 		// dd($data);
 		 $roles = Input::get('role_id');
 		 
 		$user=new User([
 			'name'=>$data->name,
 			'email'=>$data->email,
 			'password'=>Hash::make($data->password),
 			
 			]);
 		// dd($user);
 			$user->save();
 			// dd($user);
 			if(!empty($roles)){
 				foreach($roles as $role)
 					$user->roles()->attach($role);
 			}
 			
 			return Common::getJsonResponse(true, 'New user created successfully !', 200);
 		}


 	public function editUser($data){
 		 $roles = Input::get('role_id');

 		// dd($group);
 		$user=User::findorFail($data->id);
 		// dd($user);
 		$user->name=$data->name;
 		$user->password=Hash::make($data->password);
 		$user->email=$data->email;

 		// dd($user);
 		$user->save();
 		$userrole=[];
 			if(!empty($roles)){
 				foreach($roles as $role){
 					$userrole[$role]=$role;
 				}
 						
 					$user->roles()->sync($userrole);
 			}
 		return Common::getJsonResponse(true, 'user updated successfully !', 200);



 	}

 

 	

}