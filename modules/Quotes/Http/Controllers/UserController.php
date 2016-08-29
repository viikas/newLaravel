<?php namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Quotes\Repositories\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
// use Request;
// use Illuminate\Support\Facades\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use Modules\Quotes\Entities\UserModel;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller {
	 protected $UserRepo;
    
    public function __construct(UserInterface $userInterface) {
        $this->userRepo=$userInterface;
        // $this->profileaccessoriesRepo = $ProfileAccessoriesInterface;
    }
  public function getPermission()
  {
      $permission=$this->userRepo->getPermission();
            return response()->json($permission);
  }
  
  public function getRoles()
  {
      $roles=$this->userRepo->getRoles();
            return response()->json($roles);
  }
  

	 public function addRoles(Request $request) {
	 	// dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $add = $this->userRepo->addNewRole($data);

        return $add;
    }

     public function editRoles(Request $request) {
	 	// dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $edit = $this->userRepo->editRoles($data);

        return $edit;
    }

    public function getGroup(){
    	  $group=$this->userRepo->getGroups();
            return response()->json($group);
    }


 public function addGroup(Request $request) {
	 	// dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $add = $this->userRepo->addGroup($data);

        return $add;
    }


      public function editGroup(Request $request) {
	 	// dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $edit = $this->userRepo->editGroup($data);

        return $edit;
    }

  public function getUser(){
    	  $user=$this->userRepo->getUsers();
            return response()->json($user);
    }


     public function addUser(Request $request) {
        // dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $add = $this->userRepo->addUser($data);

        return $add;
    }




      public function editUser(Request $request) {
    // dd($request);
         $data = json_decode(json_encode($request->all()));
        // dd($data);
        $edit = $this->userRepo->editUser($data);

        return $edit;
    }



     public function authenticate(Request $request) {
        // dd($request);
        //  $data = json_decode(json_encode($request->all()));
        // // dd($data);
        // $authenticate = $this->userRepo->authenticate($data);

        // return  $authenticate;

      // $credentials=$request->only('username','password');
      // dd($credentials);
      // Hash::make($data->password)
    // "username"=>$request->username,
    // "password"=>Hash::make($request->password)
      // $user = new \stdClass();
      // $user->username=$request['username'];
      // $user->password=Hash::make($request['password']);


    //   $credentials=$request->only('username','password');
    //   // $credentials-> Hash::make($request['password']);
    // // dd($credentials);
    //   // dd($token);
    //   try {
    //         // verify the credentials and create a token for the user
    //        if (! $token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'invalid_credentials'], 401);
    //         }
    //         }catch (JWTException $e) {
    //         // something went wrong
    //         return response()->json(['error' => 'could_not_create_token'], 500);
    //     }
    //       return response()->array(compact('token'))->setStatusCode(200);
    // }

       $data = json_decode(json_encode($request->all()));
         $auth = $this->userRepo->authenticate($data);

        return $auth;

}

}