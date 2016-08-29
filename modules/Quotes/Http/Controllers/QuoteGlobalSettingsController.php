<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use Modules\Quotes\Repositories\GlobalSettingInterface;

use Illuminate\Http\JsonResponse;
use Modules\Quotes\Http\Requests\CreateGlobalSettingsRequest;

class QuoteGlobalSettingsController extends Controller {

    protected $globalsettingRepo;


    public function __construct(GlobalSettingInterface $globalsettingInterface) {
        $this->globalsettingRepo = $globalsettingInterface;
    }

   
    public function get()
    {
            $allSettings=$this->globalsettingRepo->getAllSettings();
            return response()->json($allSettings);

}
    // public function get() {
    //     $allSettings = $this->globalsettingRepo->getAllSettings();
    //     return response()->json($allSettings);

    // }

    public function getById($id) {
        $settings = $this->globalsettingRepo->getSingleSetting($id);
        return response()->json($settings);
    }

    // public function add(Request $request) {    
    //     $settings=$this->globalsettingRepo->getSingleSetting($id);
    //     return response()->json($settings);
    // }


    public function add(CreateGlobalSettingsRequest $request){ 
        $data=json_decode(json_encode($request->all()));
        $response=$this->globalsettingRepo->storesettings($data);
        return $response;

    }
    // public function edit($id){

    //     $edit=$this->globalsettingRepo->editsettings($id);
    //     return response()->json($edit);

    // }

    // public function update(CreateGlobalSettingsRequest $request, $id){
    //      $data=json_decode(json_encode($request->all()));
    //     $update=$this->globalsettingRepo->updatesettings($data);
    //     return $update;

    // }


     public function getSettingsByType($type){
        //dd($type);
        $data=$this->globalsettingRepo->getSettingsByType($type);
        return response()->json($data);

     }


     public function addsetting(CreateGlobalSettingsRequest $request){ 

        $data=json_decode(json_encode($request->all()));
        $response=$this->globalsettingRepo->addSetting($data);
        return $response;

    }
      public function updatesetting(CreateGlobalSettingsRequest $request){ 
        $data=json_decode(json_encode($request->all()));
        $response=$this->globalsettingRepo->updateSetting($data);
        return $response;

    }

// public function delete($id){
//         $del=$this->globalsettingRepo->deletesettings($id);
//         return response()->json($del);

//     }
    


   

    // public function update(Request $request, $id) {
    //     $update = $this->globalsettingRepo->updatesettings($id);
    //     return response()->json($update);
    // }

    // public function delete($id) {
    //     $del = $this->globalsettingRepo->deletesettings($id);
    //     return response()->json($del);
    // }



   

}

