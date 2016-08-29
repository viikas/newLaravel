<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\TemplatesInterface;
use Modules\Quotes\Entities\Template;
use Modules\Quotes\Entities\TemplateSettings;
use Modules\Quotes\Entities\TemplateProfiles;
use \Modules\Quotes\Entities\TemplateAccessories;
use Modules\Quotes\Entities\InfillModel;

use Modules\Quotes\Entities\ProductCategory;
use Modules\Quotes\Entities\Product;
use Modules\Quotes\Entities\OpportunityProduct;

use Modules\Quotes\Repositories\Common\Common;
use Illuminate\Support\Facades\Input;
class TemplatesRepo implements TemplatesInterface {

    public function getAllTemplates() {
        return Template::all();
    }

    public function getActiveTemplates() {
        return Template::where('is_active', 1)->get();
    }

    public function getActiveTemplatesByOppId($oppId) {
        $query = Template::where('is_active', 1);
        $products = OpportunityProduct::listProductsByOppId($oppId)->lists("product_id");

        if($products && $products->count() > 0) {
            $query->whereIn('product_model_id', $products);
        }
        return $query->get();
    }

    public function getSingleTemplate($templateID) {
        // $data = Template::with('settings')
        //         ->with([
        //             'profiles.sections' => function($q) {
        //                 $q->select('id', 'number', 'weight', 'notes');
        //             }])
        //         ->with([
        //             'accessories.price' => function($q){
        //             $q->where('deleted','=',NULL);
        //             $q->select('product_id','revised_price');
        //         }])
        //         ->with([
        //             'accessories.details' => function($q) {
        //                 $q->where('deleted', '=', NULL);
        //                 $q->select('id', 'code', 'sl_detail','is_length');
        //             }])
        //         ->with('infill')
        //         ->find($templateID);


        //------------------------------Samyak july 27 2016-----------


        // $data1=\DB::table('quote_template_accessories')->where('is_additional','=','0')->get();
        // $data2=\DB::table('quote_template_accessories')->where('is_additional','=','1')->get();
        // $data = new \stdClass();
        // $data->accessories = $data1;
        // $data->additional_accessories = $data2;

        //  $array = $data->toArray();
        
          // $collection = collect($array);

        $data=Template::with('settings')
                ->with([
                    'profiles.sections' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                ->with([
                    'additional_profile.sectionsAdd' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                 ->with([
                                 'accessories.details' => function($q) {
                                $q->where('deleted', '=', NULL);
                                $q->select('id', 'code', 'sl_detail','is_length');
                    }])
                ->with([
                    'accessories.price' => function($q){
                    $q->where('deleted','=',NULL);
                    $q->select('product_id','revised_price');
                }])
                ->with([
                    'accessories.details' => function($q) {
                        $q->where('deleted', '=', NULL);
                        $q->select('id', 'code', 'sl_detail','is_length');
                    }])
                ->with([
                    'additional_accessories.price1' => function($q){
                    $q->select('quote_additional_accessory_id','revised_price');
                }])
                ->with([
                    'additional_accessories.details1' => function($q) {
                        // $q->where('deleted', '=', NULL);
                        $q->select('id', 'accessory_code as code', 'accessory_name as sl_detail','is_length');
                    }])

                ->with('infill')->find($templateID);




        return $data;
        // $q=Template::with('settings')->with($array)->find($templateID);



        // return $q;



        /* $template=Template::with('settings')
          ->with([
          'child' => function ($q) {
          $q->where('someCol', 'someVa'); //constraint on child
          },'child.grandchild' => function ($q) {
          $q->where('someOtherCol', 'someOtherVal'); //constraint on grandchild
          }
          ]); */
    }

    public function getSingleActiveTemplate($templateID) {
        $data = Template::with('settings')
                        ->with([
                            'profiles.sections' => function($q) {
                                $q->select('id', 'number', 'weight', 'notes');
                            }])
                        ->with([
                            'accessories.price' => function($q) {
                                $q->where('deleted', '=', NULL);
                                $q->select('id', 'revised_price');
                            }])
                      ->with([
                                 'accessories.details' => function($q) {
                                $q->where('deleted', '=', NULL);
                                $q->select('id', 'code', 'sl_detail','is_length');
                    }])
                        ->with([
                                'additional_accessories.price1' => function($q){
                                $q->select('quote_additional_accessory_id','revised_price');
                                }])
                        // ->with('additional_accessories.details1')
                        ->with([
                                'additional_accessories.details1' => function($q) {
                                $q->select('id', 'accessory_code as code', 'accessory_name as sl_detail','is_length');
                            }])
                         ->with([
                    'additional_profile.sectionsAdd' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                                ->where('is_active', 1)->find($templateID);
        //return \DB::getQueryLog();
        return $data;
        /* $template=Template::with('settings')
          ->with([
          'child' => function ($q) {
          $q->where('someCol', 'someVa'); //constraint on child
          },'child.grandchild' => function ($q) {
          $q->where('someOtherCol', 'someOtherVal'); //constraint on grandchild
          }
          ]); */
    }

    public function getActiveTemplatesByIDs($ids) {
        $ids_array = explode(',', $ids);
       // dd($ids_array);
       // dd($ids);
        $data = Template::with('settings')
                ->with([
                    'profiles.sections' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                 ->with([
                    'additional_profile.sectionsAdd' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                ->with([
                    'accessories.price' => function($q) {
                        $q->where('deleted', '=', NULL);
                        $q->select('product_id', 'revised_price');
                    }])
                ->with([
                    'additional_accessories.price1' => function($q){
                    $q->select('quote_additional_accessory_id','revised_price');
                      }])
                // ->with('additional_accessories.details1')
                ->with([
                    'additional_accessories.details1' => function($q) {
                        $q->select('id', 'accessory_code as code', 'accessory_name as sl_detail','is_length');
                    }])
                ->with([
                    'accessories.details' => function($q) {
                        $q->where('deleted', '=', NULL);
                        $q->select('id', 'code', 'sl_detail','is_length');
                    }])
                ->with('infill')
                //->where('is_active',1)
                //->whereIn('id',$ids_array)->get();
                //->whereIn('id',[1,2,3])
                ->whereIn('id', $ids_array)
                ->where('is_active', 1)
                ->get();
        //dd($data);
        return $data;
        //return \DB::getQueryLog();
    }

    public function createTemplate($data) {
        // dd($data);

        // $file=Input::file('image');
        // $random_name=str_random(8);
        // $destinationPath='images/';
        // $extension=$file->getClientOriginalExtension();
        
        // $filename=$random_name.'_template_image.'.$extension;  

        // $uploadSuccess=Input::file('image')->move($destinationPath,$filename);

        $template = new Template([
            'code' => $data->code,
            'product_model_id' => $data->product_model_id,
            'description' => $data->description,
           
           // 'image'=>$filename,
            'type' => $data->type,
            // 'is_active' => $data->is_active,
            'is_active' => $data->is_active
        ]);
        //dd($data);
        //-------------image upload-------
        // $file=Input::file('image');
        // $random_name=str_random(8);
        // $destinationPath='images/';
        // $extension=$file->getClientOriginalExtension();
        // $filename=$random_name.'_template.'.$extension;
        // $uploadSuccess=Input::file('image')->move($destinationPath,$filename);
        //--------------------------------


        $settingsData = json_decode(json_encode($data->settings), true);
        $profilesData = json_decode(json_encode($data->profiles), true);
        $accessoriesData = json_decode(json_encode($data->accessories), true);
        $infillData=json_decode(json_encode($data->infill),true);
        try {
            \DB::beginTransaction();
            $template->save();

            foreach ($settingsData as $key => $value) {
                $settingsData[$key]['quote_template_id_fk'] = $template->id;
            }

            foreach ($profilesData as $key => $value) {
                $profilesData[$key]['quote_template_id_fk'] = $template->id;
            }

            foreach ($accessoriesData as $key => $value) {
                $accessoriesData[$key]['quote_template_id_fk'] = $template->id;
            }
            foreach($infillData as $key =>$value){
                $infillData[$key]['quote_template_id_fk']=$template->id;

            }

            \DB::table('quote_template_settings')->insert($settingsData);
            \DB::table('quote_template_profiles')->insert($profilesData);
            \DB::table('quote_template_accessories')->insert($accessoriesData);
            \DB::table('quote_template_infilling')->insert($infillData);

            \DB::commit();
            return Common::getJsonResponse(true, 'New template created successfully !', 200);
        } catch (\Exception $ex) {
            return Common::getJsonResponse(true, $ex, 200);
        }
    }

    public function updateTemplate($data) {
     //     $file=Input::file('image');
     //  $random_name=str_random(8);
     //   $destinationPath='images/';
     // $extension=$file->getClientOriginalExtension();
     // // dd($extension);
     // $filename=$random_name.'_template_image.'.$extension;  

     // $uploadSuccess=Input::file('image')->move($destinationPath,$filename);




        $template = Template::findOrFail($data->id);
        if ($template == nullOrEmptyString()) {
            return Common::getJsonResponse(false, 'Template does not exist.', 200);
        }
        $template->code = $data->code;
        $template->description = $data->description;
       
        // $template->image=$filename;
        $template->type = $data->type;
        
        $template->is_active = $data->is_active;
        $template->product_model_id = $data->product_model_id;

        $settingsData = json_decode(json_encode($data->settings), true);
        $profilesData = json_decode(json_encode($data->profiles), true);
        $accessoriesData = json_decode(json_encode($data->accessories), true);
        $infillData=json_decode(json_encode($data->infill),true);
        // dd($infillData);
        try {
            \DB::beginTransaction();
            $template->save();
            $settings_ids_to_delete = array();
            $settings_to_insert = Common::searchArray($settingsData, "id", 0);
            foreach ($settingsData as $key => $value) {
                $setting_id = $settingsData[$key]['id'];
                //update if existing setting item                
                if ($setting_id > 0) {
                    $setting = TemplateSettings::find($setting_id);
                    if ($setting != null) {
                        $setting->update($settingsData[$key]);
                        $settings_ids_to_delete[] = $setting_id;
                    }
                }
            }

            //delete all setting items that are not present in this
            //request for this tempate
            $settings_to_delete = TemplateSettings::where('quote_template_id_fk', $data->id)->whereNotIn('id', $settings_ids_to_delete)->delete();

            //insert all new setting items
            //insert settings items with id=0
            foreach ($settings_to_insert as $key => $value) {
                $settings_to_insert[$key]['quote_template_id_fk'] = $data->id;
            }
            \DB::table('quote_template_settings')->insert($settings_to_insert);

            $profile_ids_to_delete = array();
            $profiles_to_insert = Common::searchArray($profilesData, "id", 0);
            foreach ($profilesData as $key => $value) {
                $profile_id = $profilesData[$key]['id'];
                //update if existing setting item                
                if ($profile_id > 0) {
                    $profile = TemplateProfiles::find($profile_id);
                    if ($profile != null) {
                        $profile->update($profilesData[$key]);
                        $profile_ids_to_delete[] = $profile_id;
                    }
                }
            }
            //delete all profile items that are not present in this
            //request for this tempate
            TemplateProfiles::where('quote_template_id_fk', $data->id)->whereNotIn('id', $profile_ids_to_delete)->delete();
            //insert all new profiles items
            //insert profiles items with id=0
            foreach ($profiles_to_insert as $key => $value) {
                $profiles_to_insert[$key]['quote_template_id_fk'] = $data->id;
            }
            \DB::table('quote_template_profiles')->insert($profiles_to_insert);

            $accessory_ids_to_delete = array();
            $accessories_to_insert = Common::searchArray($accessoriesData, "id", 0);
            foreach ($accessoriesData as $key => $value) {
                $accessory_id = $accessoriesData[$key]['id'];
                //update if existing accessory item                
                if ($accessory_id > 0) {
                    $accessory = TemplateAccessories::find($accessory_id);
                    if ($accessory != null) {
                        $accessory->update($accessoriesData[$key]);
                        $accessory_ids_to_delete[] = $accessory_id;
                    }
                }
            }
            //delete all accessory items that are not present in this
            //request for this tempate
            TemplateAccessories::where('quote_template_id_fk', $data->id)->whereNotIn('id', $accessory_ids_to_delete)->delete();
            //insert all new accessory items
            //insert accessory items with id=0
            foreach ($accessories_to_insert as $key => $value) {
                $accessories_to_insert[$key]['quote_template_id_fk'] = $data->id;
            }
            \DB::table('quote_template_accessories')->insert($accessories_to_insert);



             $infill_ids_to_delete=array();
             $infill_to_insert=Common::searchArray($infillData,"id",0);
             foreach ($infillData as $key =>$value){
                 $infill_id=$infillData[$key]['id'];
                 if($infill_id > 0) {
                    $infill=InfillModel::find($infill_id);
                         if($infill != null){
                             $infill->update($infillData[$key]);
                             $infill_ids_to_delete[]=$infill_id;
                        }
                }

            }
            // dd($infill_to_insert);
          InfillModel::where('quote_template_id_fk',$data->id)->whereNotIn('id',$infill_ids_to_delete)->delete();
            foreach( $infill_to_insert as $key => $value){
                $infill_to_insert[$key]['quote_template_id_fk']=$data->id;
            }
             \DB::table('quote_template_infilling')->insert($infill_to_insert);

            \DB::commit();
            return Common::getJsonResponse(true, 'Template updated successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(false, $e->getMessage(), 300);
        }
    }

    //copy and create new template from existing one
    //$data [id, code, description]
    //sangam: 2016-05-16
    public function copy($data)
    {
        $template = Template::findOrFail($data->id);
        $templateNew = new Template([
            'code' => $data->code,
            'description' => $data->description,
            'image' => $template->image,
            'type' => $template->type,
            'is_active' => 0
        ]);
        $settingsData = $template->settings->toArray();
        //dd($settingsData);
        $profilesData = $template->profiles->toArray();
        $accessoriesData = $template->accessories->toArray();
        try {
            \DB::beginTransaction();
            $templateNew->save();

            foreach ($settingsData as $key => $value) {
                $settingsData[$key]['quote_template_id_fk'] = $templateNew->id;
                $settingsData[$key]['id'] = null;
            }

            foreach ($profilesData as $key => $value) {
                $profilesData[$key]['quote_template_id_fk'] = $templateNew->id;
                $profilesData[$key]['id'] = null;
            }

            foreach ($accessoriesData as $key => $value) {
                $accessoriesData[$key]['quote_template_id_fk'] = $templateNew->id;
                $accessoriesData[$key]['id'] = null;
            }

            \DB::table('quote_template_settings')->insert($settingsData);
            \DB::table('quote_template_profiles')->insert($profilesData);
            \DB::table('quote_template_accessories')->insert($accessoriesData);

            \DB::commit();
            return Common::getJsonResponse(true, $templateNew->id, 200);    
         } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(false, $e->getMessage(), 300);
        }
    }

    public function getProducts() {
        return Product::with('productModels')->get();
    }

    

}
