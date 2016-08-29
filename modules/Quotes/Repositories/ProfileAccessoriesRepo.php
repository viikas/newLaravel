<?php

namespace Modules\Quotes\Repositories;

use Modules\Quotes\Entities\Template;
use \Modules\Quotes\Repositories\ProfileAccesoriesInterface;
use Modules\Quotes\Entities\ProductPriceRevision;
// use Modules\Quotes\Entities\TemplateSettings;
use Modules\Quotes\Entities\InventoryAccessories;
use \Modules\Quotes\Entities\InventorySections;
use Modules\Quotes\Repositories\Common\Common;
use DB;
use Illuminate\Support\Collection;
use Modules\Quotes\Entities\QuoteAdditionalProfiles;
use Modules\Quotes\Entities\QuoteAdditionalAccessories;
use Modules\Quotes\Entities\QuoteCmsModel;
use Carbon;
use Modules\Quotes\Entities\AdditionalProfilePriceRevisionModel;
use Modules\Quotes\Entities\AdditionalAccessoriesPriceRevisionModel;
use Modules\Quotes\Entities\QuoteProfileModel;
use Modules\Quotes\Entities\ProfilePriceRevisionModel;
use Modules\Quotes\Entities\GlassTypeModel;
use Modules\Quotes\Entities\BoardModel;
use Modules\Quotes\Entities\GlassTypeThicknessModel;
use Modules\Quotes\Entities\QuoteQuote;
use Modules\Quotes\Entities\QuoteItemTemplateProfile;
use Modules\Quotes\Entities\TemplateProfiles;
use Modules\Quotes\Entities\CMSData;
use Modules\Quotes\Entities\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
///use Input;
use Illuminate\Support\Facades\Input;
//use Modules\Quotes\Entities\Template;
class ProfileAccessoriesRepo implements ProfileAccessoriesInterface {

    public function getProfileAccessory() {



        $profile_price = ProductPriceRevision::select('revised_price')
                ->whereNull('product_id')
                ->whereNull('deleted')
                ->first();
        $profiles = InventorySections::select('id', 'number', 'weight', 'notes')->get();
        // $accessories = DB::table('invent_accessory')
        //         ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
        //         ->select('invent_accessory.id', 'code', 'sl_detail', 'revised_price')
        //         ->get();


        $accessories = \DB::table(\DB::raw("(SELECT * FROM quote_product_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_product_price_revision b WHERE a.product_id=b.product_id)ORDER BY product_id ASC)as AccessoryRevision"))
                ->join('invent_accessory', 'invent_accessory.id', '=', 'AccessoryRevision.product_id')
                ->select('invent_accessory.id', 'code', 'sl_detail','is_length', 'invent_price', 'revised_price', 'created_at')
                ->get();

        $additionalaccessories = \DB::table(\DB::raw("(SELECT * FROM quote_additional_accessories_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_additional_accessories_price_revision b WHERE a.quote_additional_accessory_id =b.quote_additional_accessory_id )ORDER BY quote_additional_accessory_id  ASC)as AddAccRevision"))
                ->join('quote_additional_accessories', 'quote_additional_accessories.id', '=', 'AddAccRevision.quote_additional_accessory_id')
                // ->select('quote_additional_accessories.id','accessory_category_name','accessory_code','accessory_name','remarks','revised_price','AddAccRevision.created_at')
                ->select('quote_additional_accessories.id', 'accessory_code as code', 'accessory_name as sl_detail', 'revised_price', 'AddAccRevision.created_at','quote_additional_accessories.is_length')
                ->get();

        $additionalprofile = \DB::table('quote_additional_profile')
                ->select('id', 'number', 'weight', 'notes')
                ->get();
        $data = new \stdClass();
        $data->profile_price = $profile_price;
        $data->profiles = $profiles;
        $data->accessories = $accessories;
        $data->additionalprofile = $additionalprofile;
        $data->additionalaccessories = $additionalaccessories;
        return $data;
        // return $accessories;
    }

    public function getProfilePriceRevisionDates() {

        $revisiondate = ProfilePriceRevisionModel::select('updated_at')->orderBy('updated_at', 'desc')
                ->get();
        return $revisiondate;
    }

    public function getlatestProfilePriceRevision() {
        $profileprice = \DB::table('quote_profiles')
                ->join('quote_profiles_price_revision', 'quote_profiles.id', '=', 'quote_profiles_price_revision.quote_profile_id')
                ->join('product_category', 'product_category.id', '=', 'quote_profiles.category_id')
                ->select('quote_profiles_price_revision.id','quote_profiles_price_revision.is_changed', 'quote_profile_id', 'name', 'color_type', 'profile_color', 'revised_price', 'inventory_price', 'effective_date', 'deleted', 'user', 'remarks', 'quote_profiles_price_revision.created_at')
                //->whereNull('deleted')
                ->orderBy('quote_profiles_price_revision.created_at', 'desc')
                ->get();


        $array = json_decode(json_encode($profileprice, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    public function getProfiles() {

        $profile = \DB::table('quote_profiles')
                ->join('product_category', 'product_category.id', '=', 'quote_profiles.category_id')
                ->select('quote_profiles.id', 'name', 'color_type', 'profile_color')
                ->get();
        return $profile;
    }

    public function getProfilePriceRevision() {

        $profileprice = \DB::table('quote_profiles')
                ->join('quote_profiles_price_revision', 'quote_profiles.id', '=', 'quote_profiles_price_revision.quote_profile_id')
                ->join('product_category', 'product_category.id', '=', 'quote_profiles.category_id')
                ->select('quote_profiles.id', 'name', 'color_type', 'profile_color', 'revised_price', 'inventory_price', 'effective_date', 'deleted', 'user', 'remarks', 'quote_profiles_price_revision.updated_at')
                //->whereNull('deleted')
                ->get();


        $data = array('alluminium_price' => $profileprice);
        return $data;
    }

    public function getProfileLatestRevision() {
        //  $query= \DB::table(\DB::raw("(SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_acc_length c WHERE created_date=(SELECT max(created_date) FROM invent_requisition_acc_length d WHERE c.accessory_code_id=d.accessory_code_id) UNION SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC)as invent_price"))
        $query = \DB::table(\DB::raw("(SELECT * FROM quote_profiles_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_profiles_price_revision b WHERE a.quote_profile_id=b.quote_profile_id) ORDER BY quote_profile_id ASC )as ProfileRevision"))
                ->join('quote_profiles', 'ProfileRevision.quote_profile_id', '=', 'quote_profiles.id')
                // ->join('invent_accessory','invent_price.accessory_code_id','=','invent_accessory.id')
                ->join('product_category', 'product_category.id', '=', 'quote_profiles.category_id')
                ->select('quote_profiles.id', 'name', 'color_type', 'profile_color', 'inventory_price', 'revised_price', 'effective_date', 'deleted', 'user', 'remarks', 'ProfileRevision.created_at')
                //  ->orderBy('invent_accessory.id','asc')
                // ->whereNull('deleted')
                ->get();
        return $query;
    }

    public function getProfilePriceRevisionByDate($date) {

        $date_array = explode(',', $date);

        $profileprice = \DB::table('quote_profiles')
                        ->join('quote_profiles_price_revision', 'quote_profiles.id', '=', 'quote_profiles_price_revision.quote_profile_id')
                        ->join('product_category', 'product_category.id', '=', 'quote_profiles.category_id')
                        ->select('quote_profiles.id', 'name', 'color_type', 'profile_color', 'revised_price', 'inventory_price', 'effective_date', 'deleted', 'user', 'remarks', 'quote_profiles_price_revision.updated_at')
                        ->whereIn('quote_profiles_price_revision.updated_at', $date_array)->get();
        // ->whereNull('deleted')


        $array = json_decode(json_encode($profileprice, true));
        $collection = collect($array);

        $grouped = $collection->groupBy('updated_at');

        return $grouped;
    }

    public function addBulkProfilePriceRevision($revision) {

        foreach ($revision as $rev) {
            $PriceRevision = new ProfilePriceRevisionModel(
                    [
                'quote_profile_id' => $rev->quote_profile_id,
                'revised_price' => $rev->revised_price,
                'inventory_price' => $rev->inventory_price,
                'effective_date' => $rev->effective_date,
                'deleted' => $rev->deleted,
                'user' => $rev->user,
                'remarks' => $rev->remarks,
                'is_changed'=>$rev->is_changed,
                    ]
            );
            $PriceRevision->save();
        }
        return Common::getJsonResponse(true, 'Profile Price Revision added successfully !', 200);
    }

    // public function updatePriceRevision($pricerevision){
    //        $data=ProductPriceRevision::findorFail($pricerevision->id);
    //          $data->product_id=$pricerevision->product_id;
    //       $data->invent_price=$pricerevision->invent_price;
    //        $data->revised_price=$pricerevision->revised_price;
    //        $data->effective_date=$pricerevision->effective_date;
    //        $data->deleted=$pricerevision->deleted;
    //       $data->remark=$pricerevision->remark;
    //       $data->user=$pricerevision->user;
    //       $data->updated_at=$pricerevision->updated_at;
    //           $data->save();
    //            return Common::getJsonResponse(true, 'pricerevision updated successfully !', 200);
    //    }



    public function updateProfilePriceRevision($pricerevision) {
        $data = ProfilePriceRevisionModel::findorFail($pricerevision->id);
        $data->quote_profile_id = $pricerevision->quote_profile_id;
        $data->revised_price = $pricerevision->revised_price;
        $data->inventory_price = $pricerevision->inventory_price;
        $data->effective_date = $pricerevision->effective_date;
        $data->deleted = $pricerevision->deleted;
        $data->user = $pricerevision->user;
        $data->remarks = $pricerevision->remarks;
        $data->is_changed = $pricerevision->is_changed;

        $data->save();

        return Common::getJsonResponse(true, ' Profile pricerevision updated successfully !', 200);
    }

    public function getAccessoryPrice() {

        // $accessoryprice=InventoryAccessories::with('pricerevision')
        //            ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
        //            ->select('invent_accessory.id', 'code', 'sl_detail')
        //           // ->select('quote_product_price_revision.updated_at')
        //           ->get();
        // $accessory = DB::table('invent_accessory')
        // ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
        // ->select('invent_accessory.id', 'code', 'sl_detail', 'revised_price','user','remark','updated_at')
        // ->orderBy('updated_at', 'desc')
        // $accessoryprice=InventoryAccessories::with('productprice')->get();


        $accessoryprice = DB::table('invent_accessory')
                ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
                ->select('invent_accessory.id', 'code', 'sl_detail', 'revised_price', 'user', 'remark')
                //->groupBy('updated_at')
                ->get();

        $data = array('accessory_price' => $accessoryprice);
        return $data;
        ##################### NOT COMPLETED######################
    }

    public function getAccessoryInventPrice() {


        // $data1=DB::select(DB::raw("SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC"));
        // $data1=DB::table('invent_requisition_accessory')->select('accessory_code_id','color_id','rate','created_date')->orderBY('accessory_code_id')->orderBy('created_date','desc')->latest('created_date')->get();
        // $data2=\DB::table('invent_requisition_acc_length')->select('accessory_code_id','color_id','rate')
        //           ->union($data1);
        // $data1=DB::select(DB::raw("SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_acc_length c WHERE created_date=(SELECT max(created_date) FROM invent_requisition_acc_length d WHERE c.accessory_code_id=d.accessory_code_id) UNION SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC"));
        // $data2=DB::select(DB::raw("SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_acc_length c WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC GROUP BY accessory_code_id UNION SELECT accessory_code_id,MAX(color_id),MAX(rate),MAX(created_date) FROM invent_requisition_accessory  GROUP BY accessory_code_id ORDER BY accessory_code_id " ));
        #data
        // $query= \DB::table(\DB::raw("({$data2->toSql()}) as invent_price"))
        $query = \DB::table(\DB::raw("(SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_acc_length c WHERE created_date=(SELECT max(created_date) FROM invent_requisition_acc_length d WHERE c.accessory_code_id=d.accessory_code_id) UNION SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC)as invent_price"))
                ->join('invent_accessory', 'invent_price.accessory_code_id', '=', 'invent_accessory.id')
                ->join('invent_color', 'invent_price.color_id', '=', 'invent_color.id')
                ->select('invent_accessory.id', 'code', 'sl_detail', 'is_length', 'rate', 'invent_color.name')
                //  ->orderBy('invent_accessory.id','asc')
                ->get();
        return $query;
        //return $data2;
    }

    public function getLatestProfilePrice() {

        $profileprice = ProductPriceRevision::select('updated_at', 'remark', 'user', 'invent_price', 'revised_price')
                ->whereNull('product_id')
                ->orderBy('updated_at', 'desc')
                //->whereNull('deleted')
                ->first();
        $data = array('alluminium_price' => $profileprice);
        return $data;
    }

    public function getLatestAccessoryPrice() {
        // $revisiondate=ProductPriceRevision::select('updated_at')->orderBy('updated_at','desc')//########get price revision date group
        //         ->with('accessory')->get();
        // return $revisiondate;
        // $data=ProductPriceRevision:: with(['accessory'=>function($q){
        //                                     $q->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
        //                                       ->select('invent_accessory.id', 'code', 'sl_detail', 'invent_price','revised_price','user','remark') ;
        //                             }])
        //                        ->where('product_id','<>','NULL')
        //                        ->whereNull('deleted')
        //                       // ->groupBy(['updated_at'])
        //                        //->select('updated_at')
        //                        //->lists('updated_at');
        //                       //->groupBy(DB::raw('DATE(updated_at)'))
        //                           // dd($data);              
        //                       ->get();



        $revision = DB::table('invent_accessory')
                ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
                ->select('quote_product_price_revision.id', 'quote_product_price_revision.product_id', 'code', 'sl_detail', 'is_length', 'invent_price', 'revised_price', 'user', 'remark', 'updated_at','quote_product_price_revision.is_changed')
                ->where('product_id', '<>', 'NULL')
                ->whereNull('quote_product_price_revision.deleted')
                //  $data->toArray();
                ->orderBy('updated_at', 'desc')
                //->first();
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('updated_at');


        return $grouped;
        // return $revision;               
    }

    public function getPriceRevisionByDate($date) {
        $date_array = explode(',', $date);


        $revision = DB::table('invent_accessory')
                        ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
                        ->select('quote_product_price_revision.id', 'quote_product_price_revision.product_id', 'code', 'is_length', 'sl_detail', 'invent_price', 'revised_price', 'user', 'remark', 'updated_at')
                        ->where('product_id', '<>', 'NULL')
                        ->whereNull('quote_product_price_revision.deleted')
                        ->whereIn('updated_at', $date_array)->get();

        //$revision=DB::table('quote_product_price_revision')->whereIn('updated_at', $date_array)->get();;

        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('updated_at');

        // dd($revision);
        return $grouped;
        // $data=DB::table('invent_accessory')
        //                 ->leftJoin('quote_product_price_revision', 'invent_accessory.id', '=', 'quote_product_price_revision.product_id')
        //                ->select('invent_accessory.id', 'code', 'sl_detail', 'invent_price','revised_price','updated_at') 
        //                ->whereIn('updated_at', $date_array)->get();
        // $data=ProductPriceRevision::where('updated_at',$date)->get();
        // $response=new \stdClass;
        // $response->revision=$data;
        //dd($data);
        //return $data;
    }

    public function getAccessoryDate() {
        $revisiondate = ProductPriceRevision::select('updated_at')->orderBy('updated_at', 'desc')
                ->get();
        return $revisiondate;
        // $revisiondate=ProductPriceRevision::select(DB::raw('DATE(`updated_at`)'))->orderBy('updated_at','desc')
        //        ->get();
        // //$date= \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $revisiondate->updated_at)->format('Y-m-d');
        // $array=json_decode(json_encode($revisiondate,true));
        //  $collection=collect($array);
        //  $grouped=$collection->groupBy(DB::raw('DATE(`updated_at`)'));
        // return $grouped;
    }

    public function addNewPriceRevision($data) {


        $PriceRevision = new ProductPriceRevision(
                [
            'product_id' => $data->product_id,
            'invent_price' => $data->invent_price,
            'revised_price' => $data->revised_price,
            'effective_date' => $data->effective_date,
            'deleted' => $data->deleted,
            'remark' => $data->remark,
            'user' => $data->user,
                // 'date'=>$data->updated_at,
                ]
        );


        //  $accessoriesData=json_decode(json_encode($data->accessories),true);
        //dd($PriceRevision);
        //try{
        //  \DB::beginTransaction();
        $PriceRevision->save();
        // foreach ($accessoriesData as $key =>$value){
        //  $accessoriesData [$key]['invent_accessory_id']=$PriceRevision->id;
        // }
        // \DB::table('invent_accessory')->insert($accessoriesData);
        //  \DB::commit();
        return Common::getJsonResponse(true, 'new price revision created successfully!', 200);
        // } catch (\Exception $ex) {
        //     return Common::getJsonResponse(true, $ex, 200);
        // }
    }

    public function updatePriceRevision($pricerevision) {
        $data = ProductPriceRevision::findorFail($pricerevision->id);

        $data->product_id = $pricerevision->product_id;
        $data->invent_price = $pricerevision->invent_price;
        $data->revised_price = $pricerevision->revised_price;
        $data->effective_date = $pricerevision->effective_date;
        $data->deleted = $pricerevision->deleted;
        $data->remark = $pricerevision->remark;
        $data->user = $pricerevision->user;
        $data->updated_at = $pricerevision->updated_at;
        $data->is_changed = $pricerevision->is_changed;
        $data->save();
        return Common::getJsonResponse(true, 'pricerevision updated successfully !', 200);
    }

    public function addBulkPriceRevision($revision) {

        foreach ($revision as $rev) {


            $PriceRevision = new ProductPriceRevision(
                    [
                'product_id' => $rev->product_id,
                'invent_price' => $rev->invent_price,
                'revised_price' => $rev->revised_price,
                'effective_date' => $rev->effective_date,
                'deleted' => $rev->deleted,
                'remark' => $rev->remark,
                'user' => $rev->user,
                'date' => $rev->updated_at,
                'is_changed'=>$rev->is_changed,
                    ]
            );
            $PriceRevision->save();
        }
        return Common::getJsonResponse(true, 'Price Revision added successfully !', 200);
        //dd($PriceRevision);
    }

    // ###################################################get additional profiles and accessories###################################################

    public function listAdditionalProfiles() {

        $additionalProfiles = QuoteAdditionalProfiles::get();
        return $additionalProfiles;
    }

    public function addAdditionalProfiles($data) {

        $additionalProfiles = new QuoteAdditionalProfiles(
                [
            'profile_category_name' => $data->profile_category_name,
            'number' => $data->number,
            'profile_name' => $data->profile_name,
            'notes' => $data->notes,
            'thickness' => $data->thickness,
            'weight' => $data->weight,
                ]
        );
        $additionalProfiles->save();
        return Common::getJsonResponse(true, 'new additional profile created successfully!', 200);
    }

    public function updateAdditionalProfiles($profile) {

        $data = QuoteAdditionalProfiles::findorFail($profile->id);
        $data->profile_category_name = $profile->profile_category_name;
        $data->number = $profile->number;
        $data->profile_name = $profile->profile_name;
        $data->notes = $profile->notes;
        $data->thickness = $profile->thickness;
        $data->weight = $profile->weight;

        $data->save();
        return Common::getJsonResponse(true, 'AdditionalProfile updated successfully !', 200);
    }

    public function deleteAdditionalProfiles($id) {
        $profiles = QuoteAdditionalProfiles::findorFail($id);
        $profiles->delete();
        return Common::getJsonResponse(true, 'Additional Profile deleted successfully!', 200);
    }

    public function listAdditionalAccessories() {


        $additionalAccessories = QuoteAdditionalAccessories::get();
        return $additionalAccessories;
    }

    public function addAdditionalAccessories($data) {

        $additionalAccessories = new QuoteAdditionalAccessories(
                [
            'accessory_category_name' => $data->accessory_category_name,
            'accessory_code' => $data->accessory_code,
            'accessory_name' => $data->accessory_name,
            'remarks' => $data->remarks,
            'is_length'=>$data->is_length,
                ]
        );
        $additionalAccessories->save();
        return Common::getJsonResponse(true, 'new additional accessory created successfully!', 200);
    }

    public function updateAdditionalAccessories($accessory) {

        $data = QuoteAdditionalAccessories::findorFail($accessory->id);
        $data->accessory_category_name = $accessory->accessory_category_name;
        $data->accessory_code = $accessory->accessory_code;
        $data->accessory_name = $accessory->accessory_name;
        $data->remarks = $accessory->remarks;
        $data->is_length=$accessory->is_length;

        $data->save();
        return Common::getJsonResponse(true, 'Additional Accessory updated successfully !', 200);
    }

    public function deleteAdditionalAccessories($id) {
        $accessories = QuoteAdditionalAccessories::findorFail($id);
        $accessories->delete();
        return Common::getJsonResponse(true, 'Additional Accessory deleted successfully!', 200);
    }

###################################################Additional Price Revision starts here#####################################

    public function getLatestAdditionalAccessoryPriceRevision() {
        $revision = DB::table('quote_additional_accessories')
                ->leftJoin('quote_additional_accessories_price_revision', 'quote_additional_accessories.id', '=', 'quote_additional_accessories_price_revision.quote_additional_accessory_id')
                //->Join('quote_additional_accessories_price_revision','quote_additional_accessories_price_revision.quote_additional_accessory_id','=','quote_additional_accessories.id')
                ->select('quote_additional_accessories_price_revision.id','quote_additional_accessories_price_revision.is_changed', 'quote_additional_accessory_id', 'accessory_category_name', 'accessory_code', 'accessory_name', 'quote_additional_accessories_price_revision.revised_price', 'user', 'remark','is_length', 'effective_date', 'quote_additional_accessories_price_revision.created_at')
                ->where('quote_additional_accessories_price_revision.revised_price', '<>', 'NULL')
                ->orderBy('created_at', 'desc')
                ->whereNull('deleted')
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
        // //dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    public function getAddAccessoryLatestRevision() {


        //  $query= \DB::table(\DB::raw("(SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_acc_length c WHERE created_date=(SELECT max(created_date) FROM invent_requisition_acc_length d WHERE c.accessory_code_id=d.accessory_code_id) UNION SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC)as invent_price"))
        $query = \DB::table(\DB::raw("(SELECT * FROM quote_additional_accessories_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_additional_accessories_price_revision b WHERE a.quote_additional_accessory_id=b.quote_additional_accessory_id) ORDER BY quote_additional_accessory_id ASC )as AddAccRevision"))
                ->join('quote_additional_accessories', 'AddAccRevision.quote_additional_accessory_id', '=', 'quote_additional_accessories.id')
                // ->join('invent_accessory','invent_price.accessory_code_id','=','invent_accessory.id')
                // ->join('product_category','product_category.id','=','quote_profiles.category_id')
                ->select('quote_additional_accessories.id', 'accessory_code', 'accessory_category_name', 'accessory_name', 'is_length','revised_price', 'effective_date', 'deleted', 'user', 'remark', 'AddAccRevision.created_at')
                //  ->orderBy('invent_accessory.id','asc')
                ->whereNull('deleted')
                ->get();
        return $query;
    }

    public function getLatestAdditionalProfilePriceRevision() {
        $revision = DB::table('quote_additional_profile')
                ->leftJoin('quote_additional_profiles_price_revision', 'quote_additional_profile.id', '=', 'quote_additional_profiles_price_revision.quote_additional_profile_id')
                ->select('quote_additional_profiles_price_revision.id', 'quote_additional_profile_id', 'profile_category_name', 'number', 'weight', 'thickness', 'profile_name', 'quote_additional_profiles_price_revision.revised_price', 'user', 'remark', 'effective_date', 'quote_additional_profiles_price_revision.created_at')
                //->select('quote_additional_profile.id','profile_category_name','profile_code','profile_name','quote_additional_profiles_price_revision.revised_price','user','remark','effective_date','quote_additional_profiles_price_revision.updated_at')
                ->where('quote_additional_profiles_price_revision.revised_price', '<>', 'NULL')
                ->whereNull('deleted')
                ->orderBy('created_at', 'desc')
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
//dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    public function getAddProfileLatestRevision() {


        $query = \DB::table(\DB::raw("(SELECT * FROM quote_additional_profiles_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_additional_profiles_price_revision b WHERE a.quote_additional_profile_id=b.quote_additional_profile_id) ORDER BY quote_additional_profile_id ASC )as AddProfileRevision"))
                ->join('quote_additional_profile', 'AddProfileRevision.quote_additional_profile_id', '=', 'quote_additional_profile.id')
                ->select('quote_additional_profile.id', 'profile_code', 'profile_category_name', 'profile_name', 'revised_price', 'effective_date', 'deleted', 'user', 'remark', 'AddProfileRevision.created_at')
                //  ->orderBy('invent_accessory.id','asc')
                ->get();
        return $query;
    }

    public function addAdditionalProfilePriceRevision($revision) {


        foreach ($revision as $rev) {


            $PriceRevision = new AdditionalProfilePriceRevisionModel(
                    [
                'quote_additional_profile_id' => $rev->quote_additional_profile_id,
                'revised_price' => $rev->revised_price,
                'effective_date' => $rev->effective_date,
                'deleted' => $rev->deleted,
                'remark' => $rev->remark,
                'user' => $rev->user,
                    ]
            );
            $PriceRevision->save();
        }
        return Common::getJsonResponse(true, 'additional profile Price Revision added successfully !', 200);
    }

    public function updateAdditionalProfilePriceRevisionModel($addprofile) {


        $data = AdditionalProfilePriceRevisionModel::findorFail($addprofile->id);
        $data->quote_additional_profile_id = $addprofile->quote_additional_profile_id;
        $data->revised_price = $addprofile->revised_price;
        $data->effective_date = $addprofile->effective_date;
        $data->deleted = $addprofile->deleted;
        $data->remark = $addprofile->remark;
        $data->user = $addprofile->user;

        $data->save();
        return Common::getJsonResponse(true, 'Additional profile price revision updated successfully !', 200);
    }

    public function getLatestAdditionalProfilePriceRevisionByDate($date) {

        $date_array = explode(',', $date);

        $revision = DB::table('quote_additional_profile')
                ->leftJoin('quote_additional_profiles_price_revision', 'quote_additional_profile.id', '=', 'quote_additional_profiles_price_revision.quote_additional_profile_id')
                ->select('quote_additional_profile.id', 'profile_category_name', 'number', 'profile_name', 'weight', 'thickness', 'quote_additional_profiles_price_revision.revised_price', 'user', 'remark', 'effective_date', 'quote_additional_profiles_price_revision.created_at')
                //->select('quote_additional_profile.id','profile_category_name','profile_code','profile_name','quote_additional_profiles_price_revision.revised_price','user','remark','effective_date','quote_additional_profiles_price_revision.updated_at')
                ->where('quote_additional_profiles_price_revision.revised_price', '<>', 'NULL')
                ->whereIn('quote_additional_profiles_price_revision.created_at', $date_array)
                //->whereNull('deleted')
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    public function addAdditionalAccessoriesPriceRevision($revision) {


        foreach ($revision as $rev) {


            $PriceRevision = new AdditionalAccessoriesPriceRevisionModel(
                    [
                'quote_additional_accessory_id' => $rev->quote_additional_accessory_id,
                'revised_price' => $rev->revised_price,
                'effective_date' => $rev->effective_date,
                'deleted' => $rev->deleted,
                'remark' => $rev->remarks,
                'user' => $rev->user,
                'is_changed'=>$rev->is_changed,
                    ]
            );
            $PriceRevision->save();
        }
        return Common::getJsonResponse(true, 'additional accessory Price Revision added successfully !', 200);
    }

    public function updateAdditionalAccessoriesPriceRevisionModel($addaccessories) {


        $data = AdditionalAccessoriesPriceRevisionModel::findorFail($addaccessories->id);
        $data->quote_additional_accessory_id = $addaccessories->quote_additional_accessory_id;
        $data->revised_price = $addaccessories->revised_price;
        $data->effective_date = $addaccessories->effective_date;
        $data->deleted = $addaccessories->deleted;
        $data->remark = $addaccessories->remark;
        $data->user = $addaccessories->user;
         $data->is_changed = $addaccessories->is_changed;

        $data->save();
        return Common::getJsonResponse(true, 'Additional accessories price revision updated successfully !', 200);
    }

    public function getLatestAdditionalAccessoryPriceRevisionByDate($date) {
        $date_array = explode(',', $date);

        $revision = DB::table('quote_additional_accessories')
                ->leftJoin('quote_additional_accessories_price_revision', 'quote_additional_accessories.id', '=', 'quote_additional_accessories_price_revision.quote_additional_accessory_id')
                //->Join('quote_additional_accessories_price_revision','quote_additional_accessories_price_revision.quote_additional_accessory_id','=','quote_additional_accessories.id')
                ->select('quote_additional_accessories.id', 'accessory_category_name', 'accessory_code', 'accessory_name', 'quote_additional_accessories_price_revision.revised_price', 'user', 'remark', 'effective_date', 'quote_additional_accessories_price_revision.created_at')
                ->where('quote_additional_accessories_price_revision.revised_price', '<>', 'NULL')
                ->whereIn('quote_additional_accessories_price_revision.created_at', $date_array)
                // ->whereNull('deleted')
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
// //dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    ################################################### CMS ################################################################

    public function getByCategory($category) {
        $category_array = explode(',', $category);

        $cms = QuoteCmsModel::whereIn('category', $category_array)->get();
        $array = json_decode(json_encode($cms, true));
        $collection = collect($array);
        $grouped = $collection->groupBy('category');
        return $grouped;
    }

    public function updatecms($cms) {

        $data = QuoteCmsModel::findorFail($cms->id);

        // dd($data);
        $data->field_value = $cms->field_value;

        $data->save();
        return Common::getJsonResponse(true, 'cms updated successfully !', 200);
    }

    //endpoint for update   
    public function updatecmsData($cmsd){
        $data=CMSData::findOrFail($cmsd->id);
        $data->quote_id=$cmsd->quote_id;
        $data->cms_code=$cmsd->cms_code ;
        $data->field_value=$cmsd->field_value;
        $data->save();

        return Common::getJsonResponse(true, 'cms updated successfully !', 200);

    }
######################################################################################################

    public function getQuotesSetting() {
        $profsetting = \DB::table('product_category')
                ->join('quote_profiles', 'quote_profiles.category_id', '=', 'product_category.id')
                ->select('quote_profiles.id', 'name', 'color_type', 'profile_color')
                ->get();


        $glass = GlassTypeModel::with('glassparent')
                ->with('glassthickness')
                ->select('id', 'name', 'parent_id')
                ->where('parent_id', '<>', 'NULL')
                ->get();
        //   return $glass;
        $array = json_decode(json_encode($glass, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('glassparent.name');




        $boardsetting = BoardModel::with('boardthickness')
                ->select('id', 'type')
                ->get();
        $array = json_decode(json_encode($boardsetting, true));
        $collection = collect($array);
        //dd($collection);
        $boardgrouped = $collection;

        $data = new \stdClass();
        $data->profilesetting = $profsetting;
        $data->glass = $grouped;
        $data->board = $boardgrouped;
        return $data;
    }

    public function getInfillingProfileUnitCost($infillType, $thickness_id, $profile_id) {
        dd($infillType);
        if ($infillType == "glass") {
            $infillCost = \DB::table('quote_glass_price_revision')
                    ->where('quote_glass_type_thickness_id_fk', $thickness_id)
                    ->where('deleted', null)
                    ->select('revised_price')
                    ->get();
        } else {
            $infillCost = \DB::table('quote_board_price_revision')
                    ->where('quote_board_type_thickness_id_fk', $thickness_id)
                    ->where('deleted', null)
                    ->select('revised_price')
                    ->get();
        }
        $profCost = \DB::table('quote_profiles_price_revision')
                ->where('quote_profile_id', $profile_id)
                ->where('deleted', null)
                ->select('revised_price')
                ->get();

        $data = new \stdClass();

        $data->infill_unit_cost = $infillCost[0]->revised_price;
        $data->profile_unit_cost = $profCost[0]->revised_price;
        return $data;
    }

    public function addQuoteItemTemplateProfile($templateProfile) {

        $Profiles = new QuoteItemTemplateProfile(
                [
            'quote_item_template_id_fk' => $templateProfile->quote_item_template_id_fk,
            'aluminium' => $templateProfile->aluminium,
            'description' => $templateProfile->description,
            'formula' => $templateProfile->formula,
            'quantity' => $templateProfile->quantity,
            'qty_length' => $templateProfile->qty_length,
            'kg_meter' => $templateProfile->kg_meter,
            'amount' => $templateProfile->amount,
                ]
        );
        $Profiles->save();
        return Common::getJsonResponse(true, 'new Quote Item Template Profile created successfully!', 200);
    }

    public function updateQuoteItemTemplateProfile($templateProfile) {

        $data = QuoteItemTemplateProfile::findorFail($templateProfile->id);
        $data->quote_item_template_id_fk = $templateProfile->quote_item_template_id_fk;
        $data->aluminium = $templateProfile->aluminium;
        $data->description = $templateProfile->description;
        $data->formula = $templateProfile->formula;
        $data->quantity = $templateProfile->quantity;
        $data->qty_length = $templateProfile->qty_length;
        $data->kg_meter = $templateProfile->kg_meter;
        $data->amount = $templateProfile->amount;
        $data->save();
        return Common::getJsonResponse(true, 'Quote Item Template Profile updated successfully !', 200);
    }

    public function addQuoteTemplateProfile($profile) {
        $tempProfile = new TemplateProfiles(
                [
            'quote_template_id_fk' => $profile->quote_template_id_fk,
            'profile_id_fk' => $profile->profile_id_fk,
            'quantity' => $profile->quantity,
            'formula' => $profile->formula,
            'is_fly_screen' => $profile->is_fly_screen,
            'qty_length' => $profile->qty_length,
                ]
        );

        $tempProfile->save();
        return Common::getJsonResponse(true, 'new Quote Template Profile created successfully!', 200);
    }

    public function updateQuoteTemplateProfile($profile) {

        $data = TemplateProfiles::findorFail($profile->id);
        $data->quote_template_id_fk = $profile->quote_template_id_fk;
        $data->profile_id_fk = $profile->profile_id_fk;
        $data->quantity = $profile->quantity;
        $data->formula = $profile->formula;
        $data->is_fly_screen = $profile->is_fly_screen;
        $data->qty_length = $profile->qty_length;

        $data->save();
        return Common::getJsonResponse(true, 'Quote Template Profile updated successfully !', 200);
    }

    public function updateQuoteTemplates($templates) {

        $data = Template::findOrFail($templates->id);
        $data->is_active = $templates->is_active;
        $data->remarks = $templates->remarks;
        $data->save();

        return Common::getJsonResponse(true, 'Quote Template updated successfully !', 200);
    }

################################################image upload############################################################
//     public function uploadImage($form_data){
//          $validator = Validator::make($form_data, Image::$rules, Image::$messages);

//         if ($validator->fails()) {

//             return Response::json([
//                 'error' => true,
//                 'message' => $validator->messages()->first(),
//                 'code' => 400
//             ], 400);

//         }
//         $photo=$form_data['file'];
//         $originalName=$photo->getClientOriginalName();
//         $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);

//         $filename=$this->sanitize($originalNameWithoutExt);
//         $allowed_filename=$this->createUniqueFilename($filename);
//         $filennameExt=$allowed_filename .'.jpg';
//         $uploadSuccess1=$this->original($photo ,$filenameExt);
//        // $uploadSuccess2=$this->icon($photo, $filenameExt);
//         if(!$uploadSuccess1 ){
//             return Response::json([

//                 'error'=>true,
//                 'message'=>'Server error while uploading',
//                 'code'=>500
//                 ],500);
//         }

//         $sessionImage=new Image;
//         $sessionImage->filename=$allowed_filename;
//         $sessionImage->original_name=$originalName;
//         $sessionImage->save();
//         return Response::json([
//             'error'=>false,
//             'message'=>'image uploaded successfully',
//             'code'=>200
//             ],200);

// }

//     public function createUniqueFilename($filename)
//     {
//         $full_size_dir = Config::get('images.full_size');
//         $full_image_path = $full_size_dir . $filename . '.jpg';

//         if ( File::exists( $full_image_path ) )
//         {
           
//             $imageToken = substr(sha1(mt_rand()), 0, 5);
//             return $filename . '-' . $imageToken;
//         }

//         return $filename;
//     }
//      public function original( $photo, $filename )
//       {
//         $manager = new ImageManager();
//         $image = $manager->make( $photo )->encode('jpg')->save(Config::get('images.full_size') . $filename );

//          return $image;
//     }



//      public function deleteImage( $originalFilename)
//     {

//         $full_size_dir = Config::get('images.full_size');
//         $icon_size_dir = Config::get('images.icon_size');

//         $sessionImage = Image::where('original_name', 'like', $originalFilename)->first();


//         if(empty($sessionImage))
//         {
//             return Response::json([
//                 'error' => true,
//                 'code'  => 400
//             ], 400);

//         }

//         $full_path1 = $full_size_dir . $sessionImage->filename . '.jpg';
//        // $full_path2 = $icon_size_dir . $sessionImage->filename . '.jpg';

//         if ( File::exists( $full_path1 ) )
//         {
//             File::delete( $full_path1 );
//         }

//         // if ( File::exists( $full_path2 ) )
//         // {
//         //     File::delete( $full_path2 );
//         // }

//         if( !empty($sessionImage))
//         {
//             $sessionImage->delete();
//         }

//         return Response::json([
//             'error' => false,
//             'code'  => 200
//         ], 200);
//     }


//     function sanitize($string, $force_lowercase = true, $anal = false)
//     {
//         $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
//             "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
//             "â€”", "â€“", ",", "<", ".", ">", "/", "?");
//         $clean = trim(str_replace($strip, "", strip_tags($string)));
//         $clean = preg_replace('/\s+/', "-", $clean);
//         $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

//         return ($force_lowercase) ?
//             (function_exists('mb_strtolower')) ?
//                 mb_strtolower($clean, 'UTF-8') :
//                 strtolower($clean) :
//             $clean;
//     }



// public function addImage($image){
//    // dd($image);
//     $extension=$image->getClientOriginalExtension();
//     dd($extension);
//     Storage::disk('local')->put($image->getFilename().'.'.$extension,File::get($image));
//     $entry=new Image();
//     $entry->mime=$image->getClientMimeType();
//     $entry->original_filename=$image->getClientOriginalName();
//     $entry->filename=$image->getFilename().'.'.$extension;
//     $entry->save();
//     return Common::getJsonResponse(true, 'image created successfully!', 200);

// }


public function postAdd(){
   // dd($data);
    $rules=array(
        'image'=>'mimes:jpg,jpeg,bmp,png'
        );
    $validator=Validator::make(Input::all(),$rules);
   // dd($validator);
    if($validator->fails()){
         return Common::getJsonResponse(false, 'Invalid file type!', 500);

    }

    // $file=Input::file('image');
    //dd($data);

 
   // dd($data);
       //$input=Input::all();
      //dd($input);
    //$imagename=$data->image;
     $file=Input::file('image');
     // dd($file);
     $random_name=str_random(8);
     $destinationPath='images/';
     $extension=$file->getClientOriginalExtension();
     // dd($extension);
     $filename=$random_name.'_template_image.'.$extension;  

     $uploadSuccess=Input::file('image')->move($destinationPath,$filename);
     Image::create(array(
         'image'=>$filename,
        'description'=>Input::get('description')
         ));
     return Common::getJsonResponse(true, 'image created', 200);
}




}
