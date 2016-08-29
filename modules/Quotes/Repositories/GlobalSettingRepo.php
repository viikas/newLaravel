<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\GlobalSettingInterface;
use Modules\Quotes\Entities\QuoteGlobalSettings;

use Modules\Quotes\Repositories\Common\Common;

class GlobalSettingRepo implements GlobalSettingInterface {

    public function getSettingsByType($type)
    {
        $data=QuoteGlobalSettings::where('setting_type',$type)->get();

               //->groupBy('setting_type');
                $response=new \stdClass;
                $response->settings=$data;
        return $data;
        //return list of that type
    }

    public function addSetting($setting)
    {
       // dd($setting);
         $data = new QuoteGlobalSettings(

            [
       'field_code'=>$setting->field_code,
       'field_name'=>$setting->field_name,
       'field_value'=>$setting->field_value,
       'field_data_type'=>$setting->field_data_type,
       'remark'=>$setting->remark,
       'setting_type'=>$setting->setting_type,
       'created_by'=>$setting->created_by,

       'updated_by'=>$setting->updated_by,
    
            ]
            );
        
          $data->save();
            return Common::getJsonResponse(true, 'New Globalsettings created successfully !', 200);

    }

    public function updateSetting($setting)
    {

        $data=QuoteGlobalSettings::findorFail($setting->id);
        $data->field_code=$setting->field_code;
       $data->field_name=$setting->field_name;
        $data->field_value=$setting->field_value;
        $data->field_data_type=$setting->field_data_type;
        $data->remark=$setting->remark;
        $data->setting_type=$setting->setting_type;
       $data->created_by=$setting->created_by;
        $data->updated_by=$setting->updated_by;
           $data->save();
            return Common::getJsonResponse(true, 'Globalsettings updated successfully !', 200);

    }

    public function getAllSettings() {
        return QuoteGlobalSettings::all();
    }

    public function getSingleSetting($settingID) {
        return QuoteGlobalSettings::find($settingID);
    }


    public function storesettings($data){
    	
    	// $input=Request::all();
    	// return QuoteGlobalSettings::create($input);
        $settings = new QuoteGlobalSettings(
            [
     'field_code'=>$data->field_code,
    'field_name'=>$data->field_name,
   'field_value'=>$data->field_value,
    'field_data_type'=>$data->field_data_type,
    'remark'=>$data->remark,
    'setting_type'=>$data->setting_type,
    
            ]
            );
        //  dd($settings);
        try {
            \DB::beginTransaction();
            $settings->save();
            \DB::commit();
           return Common::getJsonResponse(true, 'New Global settings created successfuly !', 200);
        } catch (\Exception $ex) {
            return Common::getJsonResponse(true, $ex, 200);
        }

   }
    public function updatesettings($data){
    
    	$settings=QuoteGlobalSettings::findorFail($data->id);
         if ($settings == null()) {
            return Common::getJsonResponse(false, 'Global setting does not exist.', 200);
        }


        $settings->field_code=$data->field_code;
        $settings->field_name=$data->field_name;
        $settings->field_value=$data->field_value;
        $settings->field_data_type=$data->field_data_type;
        $settings->remark=$data->remark;
        $settings->setting_type=$data->setting_type;

    try{
        \DB::beginTransaction();
        $setting->save();
        \DB::commit();

            return Common::getJsonResponse(true, 'Global setting updated successfully !', 200);
                 } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }
    }


 
 

   

    public function deletesettings($id) {
        $settings = QuoteGlobalSettings::findorFail($id);
        $settings->delete();
        return $settings;
    }

   




}

