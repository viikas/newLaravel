<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Quotes\Repositories\ProfileAccessoriesInterface;
use Modules\Quotes\Repositories\Models\ProfileAccessoriesListModel;
use Illuminate\Http\JsonResponse;
use Modules\Quotes\Http\Requests\GetProfileAccessoriesRequest;
use Modules\Quotes\Http\Requests\AdditionalProfileRequest;
use Modules\Quotes\Http\Requests\AdditionalAccessoriesRequest;
use Modules\Quotes\Http\Requests\CmsRequest;
use Modules\Quotes\Http\Requests\ActivityLogRequest;
use Modules\Quotes\Http\Requests\ProfilePriceRevisionRequest;

class ProfileAccessoriesController extends Controller {

    protected $profileaccessoriesRepo;

    public function __construct(ProfileAccessoriesInterface $ProfileAccessoriesInterface) {
        $this->profileaccessoriesRepo = $ProfileAccessoriesInterface;
    }

    public function get() {

        $profileaccessory = $this->profileaccessoriesRepo->getProfileAccessory();
        return response()->json($profileaccessory);

        //  $profileaccessory=$this->ProfileAccessoriesListRepo->getAllProfileAccessories();
        //  return response()->json($profileaccessory);       
    }

    public function getProfiles() {

        $profile = $this->profileaccessoriesRepo->getProfiles();
        return response()->json($profile);
    }

    public function getProfilePriceRevision() {
        $profileprice = $this->profileaccessoriesRepo->getProfilePriceRevision();
        return response()->json($profileprice);
    }

    public function getLatestProfilePriceRevision() {

        $profileprice = $this->profileaccessoriesRepo->getlatestProfilePriceRevision();
        return response()->json($profileprice);
    }

    public function getProfileLatestRevision() {

        $profile = $this->profileaccessoriesRepo->getProfileLatestRevision();
        return response()->json($profile);
    }

    public function getProfilePriceRevisionByDate($date) {
        $data = $this->profileaccessoriesRepo->getProfilePriceRevisionByDate($date);
        return response()->json($data);
    }

    public function addBulkProfilePriceRevision(ProfilePriceRevisionRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $response = $this->profileaccessoriesRepo->addBulkProfilePriceRevision($data);

        return $response;
    }

    public function updateProfilePriceRevision(ProfilePriceRevisionRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateProfilePriceRevision($data);
        return $update;
    }

    public function getAccessoryPrice() {
        $accessoryprice = $this->profileaccessoriesRepo->getAccessoryPrice();
        return response()->json($accessoryprice);
    }

    public function getProfilePriceRevisionDates() {
        $revision = $this->profileaccessoriesRepo->getProfilePriceRevisionDates();
        return response()->json($revision);
    }

    public function getLatestProfilePrice() {
        $latestProfileprice = $this->profileaccessoriesRepo->getLatestProfilePrice();
        return response()->json($latestProfileprice);
    }

    public function getLatestAccessoryPrice() {

        $latestaccessoryprice = $this->profileaccessoriesRepo->getLatestAccessoryPrice();
        return response()->json($latestaccessoryprice);
    }

    public function getPriceRevisionByDate($date) {
        $data = $this->profileaccessoriesRepo->getPriceRevisionByDate($date);
        return response()->json($data);
    }

    public function getAccessoryDate() {

        $revision = $this->profileaccessoriesRepo->getAccessoryDate();
        return response()->json($revision);
    }

    public function addPriceRevision(GetProfileAccessoriesRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $response = $this->profileaccessoriesRepo->addNewPriceRevision($data);

        return $response;
    }

    public function addBulkPriceRevision(GetProfileAccessoriesRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $response = $this->profileaccessoriesRepo->addBulkPriceRevision($data);

        return $response;
    }

    public function updatePriceRevision(GetProfileAccessoriesRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updatePriceRevision($data);
        return $update;
    }

    public function listAdditionalProfiles() {
        $data = $this->profileaccessoriesRepo->listAdditionalProfiles();
        return $data;
    }

    public function addAdditionalProfiles(AdditionalProfileRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addAdditionalProfiles($data);
        return $data;
    }

    public function updateAdditionalProfiles(AdditionalProfileRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateAdditionalProfiles($data);
        return $update;
    }

    public function deleteAdditionalProfiles($id) {

        $delete = $this->profileaccessoriesRepo->deleteAdditionalProfiles($id);
        return $delete;
    }

    public function listAdditionalAccessories() {

        $data = $this->profileaccessoriesRepo->listAdditionalAccessories();
        return $data;
    }

    public function addAdditionalAccessories(AdditionalAccessoriesRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addAdditionalAccessories($data);
        return $data;
    }

    public function updateAdditionalAccessories(AdditionalAccessoriesRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateAdditionalAccessories($data);
        return $update;
    }

    public function deleteAdditionalAccessories($id) {
        $delete = $this->profileaccessoriesRepo->deleteAdditionalAccessories($id);
        return $delete;
    }

    public function getLatestAdditionalProfilePriceRevision() {

        $revision = $this->profileaccessoriesRepo->getLatestAdditionalProfilePriceRevision();
        return response()->json($revision);
    }

    public function getAdditionalAccessoryLatestRevision() {

        $revision = $this->profileaccessoriesRepo->getAdditionalAccessoryLatestRevision();
        return response()->json($revision);
    }

    public function addAdditionalProfilePriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $response = $this->profileaccessoriesRepo->addAdditionalProfilePriceRevision($data);

        return $response;
    }

    public function addAdditionalAccessoriesPriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $response = $this->profileaccessoriesRepo->addAdditionalAccessoriesPriceRevision($data);

        return $response;
    }

    public function updateAdditionalAccessoriesPriceRevisionModel(Request $request) {

        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateAdditionalAccessoriesPriceRevisionModel($data);
        return $update;
    }

    public function updateAdditionalProfilePriceRevisionModel(Request $request) {

        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateAdditionalProfilePriceRevisionModel($data);
        return $update;
    }

    public function getLatestAdditionalAccessoryPriceRevision() {

        $revision = $this->profileaccessoriesRepo->getLatestAdditionalAccessoryPriceRevision();
        return response()->json($revision);
    }

    public function getLatestAdditionalProfilePriceRevisionByDate($date) {


        $data = $this->profileaccessoriesRepo->getLatestAdditionalProfilePriceRevisionByDate($date);
        return response()->json($data);
    }

    public function getLatestAdditionalAccessoryPriceRevisionByDate($date) {

        $data = $this->profileaccessoriesRepo->getLatestAdditionalAccessoryPriceRevisionByDate($date);
        return response()->json($data);
    }

    public function getAddAccessoryLatestRevision() {


        $revision = $this->profileaccessoriesRepo->getAddAccessoryLatestRevision();
        return response()->json($revision);
    }

    public function getAddProfileLatestRevision() {


        $revision = $this->profileaccessoriesRepo->getAddProfileLatestRevision();
        return response()->json($revision);
    }

    public function getcmsByCategory($category) {

        $data = $this->profileaccessoriesRepo->getByCategory($category);
        return response()->json($data);
    }

    public function updatecms(CmsRequest $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updatecms($data);
        return $update;
    }

    public function getlogbyId($log) {

        $data = $this->profileaccessoriesRepo->getlog($log);
        return response()->json($data);
    }

    public function addlog(ActivityLogRequest $request) {

        $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addlog($data);
        return $data;
    }

    public function getAccessoryInventPrice() {

        $accessory = $this->profileaccessoriesRepo->getAccessoryInventPrice();
        return response()->json($accessory);
    }

    public function getQuotesSetting() {

        $setting = $this->profileaccessoriesRepo->getQuotesSetting();
        return response()->json($setting);
    }
    
    //public function getInfillingProfileUnitCost($infillType,$thickness_id,$profile_id)
    public function getInfillingProfileUnitCost(Request $request)
    {
        //dd($request);
        //dd(json_decode($request->all()));
        $data = json_decode(json_encode($request->all()));
        //dd($data->infill_type);
        /*$data = json_decode(json_encode($request->all()));
        $infillType=$data->infill_type;
        $thickness_id=$data->thickness_id;
        $profile_id=$data->profile_id;*/
        $response=$this->profileaccessoriesRepo->getInfillingProfileUnitCost($data->infill_type,$data->thickness_id,$data->profile_id);
        return response()->json($response);
    }


    public function addQuotes(Request $request)
    {


        $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addQuotes($data);
        return $data;

    }

    public function addQuoteItemTemplateProfile(Request $request)
    {
     $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addQuoteItemTemplateProfile($data);
        return $data;

    }
     public function updateQuoteItemTemplateProfile(Request $request){
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateQuoteItemTemplateProfile($data);
        return $update;
    }

     public function addQuoteTemplateProfile(Request $request)
    {
     $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->addQuoteTemplateProfile($data);
        return $data;

    }
  public function updateQuoteTemplateProfile(Request $request){
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updateQuoteTemplateProfile($data);
        return $update;
    }


  public function updateQuoteTemplates(Request $request){
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updatecmsData($data);
        return $update;
    }



      public function updateCMSData(Request $request){
        $data = json_decode(json_encode($request->all()));
        $update = $this->profileaccessoriesRepo->updatecmsData($data);
        return $update;
    }


   public function addImage(Request $request){
     $data = json_decode(json_encode($request->all()));
        $data = $this->profileaccessoriesRepo->postAdd($data);
        return $data;


   }

 //   public function deleteImage($id){

 // $delete = $this->profileaccessoriesRepo->deleteImage($id);
 //        return $delete;
    
 //   }
    

}


