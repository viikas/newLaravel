<?php namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Quotes\Repositories\TemplatesInterface;
use Modules\Quotes\Repositories\ProfileAccessoriesInterface;
use Modules\Quotes\Repositories\Models\TemplateModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Quotes\Http\Requests\CreateTemplateRequest;
class TemplatesController extends Controller {
    protected $templatesRepo;
    protected $profileaccessoriesRepo;
    public function __construct(TemplatesInterface $templatesInterface, ProfileAccessoriesInterface $ProfileAccessoriesInterface) {
        $this->templatesRepo=$templatesInterface;
        $this->profileaccessoriesRepo = $ProfileAccessoriesInterface;
    }
    public function get()
    {
            $allTemplates=$this->templatesRepo->getAllTemplates();
            return response()->json($allTemplates);
    }
    public function getActive()
    {
            $allTemplates=$this->templatesRepo->getActiveTemplates();
            return response()->json($allTemplates);
    }

    public function getActiveByOpp($oppId) {
        $allTemplates=$this->templatesRepo->getActiveTemplatesByOppId($oppId);
        return response()->json($allTemplates);
    }

    public function getById($id) {    
        $template=$this->templatesRepo->getSingleTemplate($id);
        return response()->json($template);
    }    
    public function getActiveById($id) {    
        $template=$this->templatesRepo->getSingleActiveTemplate($id);
        return response()->json($template);
    }
    public function getAllByIds(Request $request) {  
        $input=$request->all();
        $ids=$input["ids"];
        //dd($ids);
        $template=$this->templatesRepo->getActiveTemplatesByIDs($ids);
        //dd($template);
        return response()->json($template);
    }


    public function getPopulate() {
        $profileaccessory = $this->profileaccessoriesRepo->getProfileAccessory();
        $products = $this->templatesRepo->getProducts();
        
        $data = ['products' => $products,
                 'profile_accessory' => $profileaccessory];
        return response()->json($data);
    }

    public function add(CreateTemplateRequest $request) { 
        $data =  json_decode(json_encode($request->all()));
        $response=$this->templatesRepo->createTemplate($data);
        return $response;
    }
    
    public function update(CreateTemplateRequest $request) { 
        $data =  json_decode(json_encode($request->all()));
        $response=$this->templatesRepo->updateTemplate($data);
        return $response;
    }

    public function copy(Request $request) { 
        $data =  json_decode(json_encode($request->all()));
        //dd($data);
        $response=$this->templatesRepo->copy($data);
        return $response;
    }    


 // public function getProfilesAccessories(){
 //        $profileaccessory=$this->templatesRepo->profileaccessory();
 //            return response()->json($profileaccessory);       

 //    }

}
