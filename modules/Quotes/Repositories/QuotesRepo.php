<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\QuotesInterface;
use Modules\Quotes\Entities\QuoteQuote;
use Modules\Quotes\Entities\Opportunity;
use Modules\Quotes\Entities\QuoteItem;
use Modules\Quotes\Entities\QuoteItemTemplate;
use Modules\Quotes\Entities\QuoteItemTemplateSetting;
use Modules\Quotes\Entities\QuoteItemTemplateProfile;
use Modules\Quotes\Entities\QuoteItemTemplateAccessory;
use Modules\Quotes\Entities\ItemTemplateInfilling;
use Modules\Quotes\Entities\GlassBible;
use Modules\Quotes\Entities\QuoteCmsModel;
use Modules\Quotes\Entities\CMSData;
use Modules\Quotes\Entities\QuoteItemImage;
use Modules\Quotes\Repositories\Common\Common;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
///use Input;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
class QuotesRepo implements QuotesInterface {

    public function getDistinctOptionByOpportunityId($opportunityId) {
        return QuoteQuote::select("id", "quote_number", "quote_option", \DB::raw("max(updated_at)"))->where('opportunity_id_fk', $opportunityId)
                        ->groupBy('quote_option')->orderBy(\DB::raw("max(updated_at)"), 'desc')->get();
    }

    public function getDistinctQuoteNbrByOpportunityId($opportunityId) {
        return QuoteQuote::select("id", "quote_number", \DB::raw("max(updated_at)"))->where('opportunity_id_fk', $opportunityId)
                        ->groupBy('quote_number')->orderBy(\DB::raw("max(updated_at)"), 'desc')->get();
    }

    public function getQuotesByOpportunityId($opportunityId) {
        $oppotunityInfo = $this->getSingleOpportunityInfo($opportunityId);
        // $allQuotes = $this->quotesRepo->getDistinctOptionByOpportunityId($opportunityId);

        $allQuotes = $this->getDistinctQuoteNbrByOpportunityId($opportunityId);

        $oppClientInfo = $this->getOpportunityClientInfo($oppotunityInfo);
        $quotesArray = $this->getQuotesDetails($allQuotes);

        return $finalResponse = array('opportunity' => $oppClientInfo,
            'quotes' => $quotesArray);
    }

    public function getRevisionsByQuoteNbrAndOption($quoteNbr, $option) {
        \DB::setFetchMode(\PDO::FETCH_ASSOC);
        return \DB::table('quote_quotes')->where("quote_number", $quoteNbr)->where("quote_option", $option)->orderBy("updated_at", "desc")->get();
    }

    public function getListByQuoteNbr($quoteNbr) {
        \DB::setFetchMode(\PDO::FETCH_ASSOC);
        return \DB::table('quote_quotes')->where("quote_number", $quoteNbr)->orderBy("updated_at", "desc")->get();
    }

    public function getByOpportunityId($opportunityId) {
        return QuoteQuote::where('opportunity_id_fk', $opportunityId)->get();
    }

    public function getSingleOpportunityInfo($opportunityId) {
        return Opportunity::with('client')->where('id', $opportunityId)->first();
    }

    public function getActiveQuotes() {
        return Template::where('is_active', 1)->get();
    }

    //updated 2016-05-11 : sangam
    public function getSingleQuote($quoteId) {
        $quoteInfo = QuoteQuote::with('items')
            ->with('quoteOpportunity')
                ->find($quoteId);
        //dd($quoteInfo);
        $all_pc = $quoteInfo->pc_unforseen + $quoteInfo->pc_engg_mgmt + $quoteInfo->pc_markup;
        $all_pc_decimal = (100 - $all_pc) / 100;
        $glass_markup_decimal = (100 - $quoteInfo->pc_glass_markup) / 100;
        //loop over items to calculate unit cost
        //dd($quoteInfo->items);
        foreach ($quoteInfo->items as $item) {
            # code...all_pc = unforseen_pc + engg_mgmt_pc + mark_up_pc
            //dd($item->total_material_cost);
            $unit_cost = (($item->total_material_cost + $item->total_fabrication_cost) / $all_pc_decimal) + ($item->total_glass_cost / $glass_markup_decimal);
            //dd($unit_cost);
            $item->unit_cost = $unit_cost / $item->quantity;
            //dd($item->unit_cost);
        }
        $oppInfo = $this->getSingleOpportunityInfo($quoteInfo->opportunity_id_fk);
        $oppClientInfo = $this->getOpportunityClientInfo($oppInfo);


        return array('quoteInfo' => $quoteInfo,
            'clientInfo' => $oppClientInfo);
    }

    public function getSingleItem($itemId) {
        $data = QuoteItem::with('itemTemplates')
                ->with(['itemTemplates.itemTemplateSettings' => function($q) {
                        
                    }])
                ->with(['itemTemplates.itemTemplateProfiles' => function($q) {
                        
                    }])
                ->with(['itemTemplates.itemTemplateAccessories' => function($q) {
                        
                    }])
                ->with(['itemTemplates.itemTemplateInfill' => function($q) {
                        
                    }])
                ->find($itemId);
        return $data;
    }

    public function getSingleActiveQuote($templateID) {
        $data = Template::with('settings')
                        ->with([
                            'profiles.sections' => function($q) {
                                $q->select('id', 'number', 'weight', 'notes');
                            }])
                        ->with([
                            'accessories.price' => function($q) {
                                $q->where('deleted', '<>', 'NULL');
                                $q->select('id', 'revised_price');
                            }])
                        ->with([
                            'accessories.details' => function($q) {
                                $q->where('deleted', '=', NULL);
                                $q->select('id', 'code', 'sl_detail');
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

    public function getActiveQuotesByIDs($ids) {
        $ids_array = explode(',', $ids);
        //dd($ids_array);
        //dd($ids);
        $data = Template::with('settings')
                ->with([
                    'profiles.sections' => function($q) {
                        $q->select('id', 'number', 'weight', 'notes');
                    }])
                ->with([
                    'accessories.price' => function($q) {
                        $q->where('deleted', '<>', 'NULL');
                        $q->select('id', 'revised_price');
                    }])
                ->with([
                    'accessories.details' => function($q) {
                        $q->where('deleted', '=', NULL);
                        $q->select('id', 'code', 'sl_detail');
                    }])
                //->where('is_active',1)
                //->whereIn('id',$ids_array)->get();
                //->whereIn('id',[1,2,3])
                ->whereIn('id', $ids_array)
                ->where('is_active', 1)
                ->get();
        return $data;
        //return \DB::getQueryLog();
    }

    public function getquotes(){
        $data=QuoteQuote::with('cmsdata')->get();
        return $data;


    }












    public function createQuote($data) {
        // print_r($data);die();
        //dd($data);
        $maxQuote = $this->getMaxQuote();
        if ($maxQuote)
            $newQuoteNbr = (int) $maxQuote + (int) 1;
        else
            $newQuoteNbr = config('quotes.QUOTE_START');
       // $data->cmsdata;
       
      
       
        $quote = new QuoteQuote();
       
         
       
        
        try {
            \DB::beginTransaction();
            $data['quote_number'] = $newQuoteNbr;
            $data['quote_option'] = 'A';
            $data['revision_number'] = '0';
            // dd($data);
            $quote->fill($data)->save();
//          
            ///////////////////////// Add cms data Samyak 6 june 2016/////////////////
            $quotecms=QuoteCmsModel::whereIn('cms_code',['quote_project_information','quote_terms_conditions','quote_foot_note','quote_validity','quote_payment_mode'])->get();
           // dd($quotecms);
            foreach ($quotecms as $cms) {
                $cmsdata=new CMSData([
                    'quote_id'=>$quote->id,
                    'cms_code'=>$cms->cms_code,
                    'field_value'=>$cms->field_value,
                    ]);
                //dd($cmsdata);
                $cmsdata->save();

              // dd($cmsdata);

            }


            
            \DB::commit();

           // $quote->save();
            return Common::getJsonResponse(true, 'New quote created successfully !', 200);
        } catch (\Exception $ex) {
            return Common::getJsonResponse(true, $ex, 200);
        }
    }

        public function getcmsByQuoteId($id){
              $ids_array = explode(',', $id);
              $data=CMSData::where('quote_id',$ids_array)->get();
              return $data;

        }



    public function updateQuote($data) {
        $quote = QuoteQuote::find($data['id']);
        if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);

        try {
            \DB::beginTransaction();
            $quote->fill($data)->save();
            \DB::commit();
            return Common::getJsonResponse(true, 'Quote updated successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }
    }

    public function createQuoteRevision($data) {
        $quote = QuoteQuote::find($data['quote_id']);
        if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);
        $maxRevNbr = $this->getMaxRevisionNbr($quote->quote_number);
        $newRevNbr = (int) $maxRevNbr + (int) 1;
        $quoteRev = new QuoteQuote();
        try {
            \DB::beginTransaction();

            $data['quote_number'] = $quote->quote_number;
            $data['quote_option'] = $quote->quote_option;
            $data['revision_number'] = $newRevNbr;

            $quoteRev->fill($data)->save();
            \DB::commit();
            return Common::getJsonResponse(true, 'Quote revision added successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }
    }

    public function createQuoteOption($data) {
        $quote = QuoteQuote::find($data['quote_id']);
        if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);
        $maxQuoteOption = $this->getMaxQuoteOption($quote->quote_number);

        $newQuoteOption = ++$maxQuoteOption;

        $quoteRev = new QuoteQuote();
        try {
            \DB::beginTransaction();

            $data['quote_number'] = $quote->quote_number;
            $data['quote_option'] = $newQuoteOption;
            $data['revision_number'] = '0';

            $quoteRev->fill($data)->save();
            \DB::commit();
            return Common::getJsonResponse(true, 'Quote option added successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }
    }

    public function createQuoteItem($data) {
        $quoteItem = new QuoteItem();
        // $infillitemData=json_decode(json_encode($data->infill),true);
        // dd($infillitemData);
        try {

            \DB::beginTransaction();
            $maxItemNbr = $this->getMaxItemNbr($data['quote_id']);


            if ($maxItemNbr)
                $newItemNbr = (int) $maxItemNbr + (int) 1;
            else
                $newItemNbr = config('quotes.ITEM_NBR_START');

            $data['item_number'] = $newItemNbr;

            $quoteItem->fill($data)->save();
            //dd($quoteItem);
            $itemTemplatesData = $data['item_templates'];
            foreach ($itemTemplatesData as $key => $value) {
                $itemTemplate = new QuoteItemTemplate();
                $value['quote_item_id_fk'] = $quoteItem->id;
                $itemTemplate->fill($value)->save();

                $templateSettings = $value['item_template_settings'];
                $templateProfiles = $value['item_template_profiles'];
                $templateAccessories = $value['item_template_accessories'];
                //samyak may 23 2016 
                $templateItemInfill = $value['item_template_infill'];

                foreach ($templateSettings as $setting) {
                    $itemTemplateSetting = new QuoteItemTemplateSetting();
                    $setting['quote_item_template_id_fk'] = $itemTemplate->id;
                    $itemTemplateSetting->fill($setting)->save();
                }

                foreach ($templateProfiles as $profile) {
                    $itemTemplateProfile = new QuoteItemTemplateProfile();
                    $profile['quote_item_template_id_fk'] = $itemTemplate->id;
                    $itemTemplateProfile->fill($profile)->save();
                }

                foreach ($templateAccessories as $accessory) {
                    $itemTemplateAccessory = new QuoteItemTemplateAccessory();
                    $accessory['quote_item_template_id_fk'] = $itemTemplate->id;
                    //dd($accessory);
                    $itemTemplateAccessory->fill($accessory)->save();
                }
                //samyak may 23 2016 
                foreach ($templateItemInfill as $infill) {
                    //dd($templateItemInfill);
                    $itemTemplateInfill = new ItemTemplateInfilling();

                    $infill['quote_item_template_id_fk'] = $itemTemplate->id;

                    $itemTemplateInfill->fill($infill)->save();
                }
                // foreach($infillitemData as $key =>$value){
                //     dd($infillitemData);
                //     $infillitemData[$key]['quote_item_template_id_fk']=$itemTemplate->id;
                //      \DB::table('quote_item_template_infilling')->insert($infillitemData);
                // }
            }

            //call quote data
            // $this->getSingleQuote($quoteItem->$quoteId);
            //  if ($is_include_vat=0){
            //      $sub_total=$sub_total_discounted;
            //      $vat=$vat;
            //      $total=$grand_total;
            //  }
            //  else
            //  {
            //      $sub_total=$sub_total_discounted+$vat;
            //      $total=$grand_total;
            //  }
            //call quote calcultion engine: 2016-05-11 : sangam
            $this->applyCalculationEngine($quoteItem->quote_id);
            \DB::commit();
            return Common::getJsonResponse(true,$quoteItem->id, 200);
        } catch (\Exception $ex) {
            \DB::rollback();
            return Common::getJsonResponse(true, $ex, 200);
        }
    }





    private function applyCalculationEngine($quote_id) {
        //dd($quote_id);
        $quote_items = QuoteItem::where('quote_id', $quote_id)->get();
        $total_material_cost = 0.00;
        $total_fabric_install_cost = 0.00;
        $total_glass_cost = 0.00;
        //dd($quote_items);
        /* foreach ($item as $quote_items) {
          $total_material_cost = 100.00;  //test value samyak may11th
          $total_fabric_install_cost = 300.00;
          $total_glass_cost = 500.00;
         */
        foreach ($quote_items as $item) {
            $total_material_cost+=$item->total_material_cost;
            $total_fabric_install_cost+=$item->total_fabrication_cost;
            $total_glass_cost+=$item->total_glass_cost;
        }

        $total_material_fabrication_cost = $total_material_cost + $total_fabric_install_cost;

        $quote = QuoteQuote:: findOrFail($quote_id);

        $pc_unforseen = $quote->pc_unforseen;
        $pc_engg_mgmt = $quote->pc_engg_mgmt;
        $pc_glass_markup = $quote->pc_glass_markup;
        $pc_skylight_markup = $quote->pc_markup;

        $total_markups_pc = $pc_unforseen + $pc_engg_mgmt + $pc_skylight_markup; //20%
        $total_markups_decimal = (100 - $total_markups_pc) / 100; //0.80

        $total_unforseen_cost = ($total_material_fabrication_cost / $total_markups_decimal) * ($pc_unforseen / 100);
        $total_engg_mgmt_cost = ($total_material_fabrication_cost / $total_markups_decimal) * ($pc_engg_mgmt / 100);
        $total_skylight_markup_cost = ($total_material_fabrication_cost / $total_markups_decimal) * ($pc_skylight_markup / 100);
        $total_markup_cost = $total_skylight_markup_cost + $total_engg_mgmt_cost + $total_unforseen_cost;

        $glass_markup_cost = $total_glass_cost / ((100 - $pc_glass_markup) / 100);

        $glass_total_with_markup = $total_glass_cost + $glass_markup_cost;

        $sub_total = $total_material_fabrication_cost + $total_markup_cost + $glass_total_with_markup;

        //apply discounts
        // if($discount_pc>0)
        //  {
        //  $discount= ( $sub_total * $discount_pc / 100);
        //  $sub_total_discounted = $sub_total - $discount;
        //  }
        //  else
        //  {
        //  $sub_total_discounted = $sub_total - $discount;
        //  } 
        //calculate vat
        $vat = $sub_total * 0.13;
        $sub_total = $sub_total - $vat;
        //finally, calculate grand total
        $grand_total = $sub_total + $vat;

        //save to quote_quotes table
        $quote->total_material_cost = $total_material_cost;
        $quote->total_fabric_install_cost = $total_fabric_install_cost;
        $quote->total_glass_cost = $total_glass_cost;

        $quote->total_unforeseen = $total_unforseen_cost;
        $quote->total_engg_mgmt = $total_engg_mgmt_cost;
        $quote->total_markup = $pc_skylight_markup;
        $quote->glass_total_markups = $glass_markup_cost;

        ///$quote->discount = $discount;
        ///$quote->sub_total_discounted = $sub_total_discounted;
        $quote->vat = $vat;
        $quote->sub_total = $sub_total;
        $quote->grand_total = $grand_total;
        //dd($quote);
        $quote->save();
    }

    public function updateQuoteItem($data) {
        $quoteItem = QuoteItem::find($data['id']);
        if ($quoteItem == nullOrEmptyString()) {             //updated by samyak may 25 2016
            return Common::getJsonResponse(false, 'Quote item does not exist.', 200);
        }
        // if (!$quoteItem)
        //     return Common::getJsonResponse(false, 'Quote item does not exist.', 200);
        try {

            \DB::beginTransaction();
            $quoteItem->fill($data)->save();

            $itemTemplatesData = $data['item_templates'];

            $template_ids_not_to_delete_array = array();
            foreach ($itemTemplatesData as $key => $value) {
                if ($value['id'] > 0) {
                    $itemTemplate = QuoteItemTemplate::find($value['id']);
                    if ($itemTemplate) {
                        $itemTemplate->update($value);
                        $template_ids_not_to_delete_array[] = $value['id'];
                    }
                } else {
                    $itemTemplate = new QuoteItemTemplate();
                    $value['quote_item_id_fk'] = $quoteItem->id;
                    $itemTemplate->fill($value)->save();
                    $template_ids_not_to_delete_array[] = $itemTemplate->id;
                }

                $templateSettings = $value['item_template_settings'];
                $templateProfiles = $value['item_template_profiles'];
                $templateAccessories = $value['item_template_accessories'];
                $templateItemInfill = $value['item_template_infill'];  //samyak may 25 2016 

                $setting_ids_not_to_delete_array = array();
                $profile_ids_not_to_delete_array = array();
                $accessory_ids_not_to_delete_array = array();
                $infill_ids_not_to_delete_array = array();  //samyak may 25 2016 


                foreach ($templateSettings as $setting) {
                    if ($setting['id'] > 0) {
                        $itemTemplateSetting = QuoteItemTemplateSetting::find($setting['id']);
                        if ($itemTemplateSetting) {
                            $itemTemplateSetting->update($setting);
                            $setting_ids_not_to_delete_array[] = $setting['id'];
                        }
                    } else {
                        $itemTemplateSetting = new QuoteItemTemplateSetting();
                        $setting['quote_item_template_id_fk'] = $itemTemplate->id;
                        $itemTemplateSetting->fill($setting)->save();
                        $setting_ids_not_to_delete_array[] = $itemTemplateSetting->id;
                    }
                }
                QuoteItemTemplateSetting::where('quote_item_template_id_fk', $itemTemplate->id)->whereNotIn('id', $setting_ids_not_to_delete_array)->delete();

                foreach ($templateProfiles as $profile) {
                    if ($profile['id'] > 0) {
                        $itemTemplateProfile = QuoteItemTemplateProfile::find($profile['id']);
                        if ($itemTemplateProfile) {
                            $itemTemplateProfile->update($profile);
                            $profile_ids_not_to_delete_array[] = $profile['id'];
                        }
                    } else {
                        $itemTemplateProfile = new QuoteItemTemplateProfile();
                        $profile['quote_item_template_id_fk'] = $itemTemplate->id;
                        $itemTemplateProfile->fill($profile)->save();
                        $profile_ids_not_to_delete_array[] = $itemTemplateProfile->id;
                    }
                }
                QuoteItemTemplateProfile::where('quote_item_template_id_fk', $itemTemplate->id)->whereNotIn('id', $profile_ids_not_to_delete_array)->delete();

                foreach ($templateAccessories as $accessory) {
                    if ($accessory['id'] > 0) {
                        $itemTemplateAccessory = QuoteItemTemplateAccessory::find($accessory['id']);
                        if ($itemTemplateAccessory) {
                            $itemTemplateAccessory->update($accessory);
                            $accessory_ids_not_to_delete_array[] = $accessory['id'];
                        }
                    } else {
                        $itemTemplateAccessory = new QuoteItemTemplateAccessory();
                        $accessory['quote_item_template_id_fk'] = $itemTemplate->id;
                        $itemTemplateAccessory->fill($accessory)->save();
                        $accessory_ids_not_to_delete_array[] = $itemTemplateAccessory->id;
                    }
                }
                QuoteItemTemplateAccessory::where('quote_item_template_id_fk', $itemTemplate->id)->whereNotIn('id', $accessory_ids_not_to_delete_array)->delete();

                //Samyak may 25 2016
                foreach ($templateItemInfill as $infill) {
                    //dd($templateItemInfill);
                    if ($infill['id'] > 0) {
                        $itemTemplateInfill = ItemTemplateInfilling::find($infill['id']);
                        if ($itemTemplateInfill) {
                            $itemTemplateInfill->update($infill);
                            $infill_ids_not_to_delete_array[] = $infill['id'];
                        }
                    } else {
                        $itemTemplateInfill = new ItemTemplateInfilling();
                        $infill['quote_item_template_id_fk'] = $itemTemplate->id;
                        $itemTemplateInfill->fill($infill)->save();
                        $infill_ids_not_to_delete_array[] = $itemTemplateInfill->id;
                    }
                }
                ItemTemplateInfilling::where('quote_item_template_id_fk', $itemTemplate->id)->whereNotIn('id', $infill_ids_not_to_delete_array)->delete();
            }
            QuoteItemTemplate::where('quote_item_id_fk', $quoteItem->id)->whereNotIn('id', $template_ids_not_to_delete_array)->delete();

            \DB::commit();
            return Common::getJsonResponse(true, 'Quote item updated successfully !', 200);
        } catch (\Exception $ex) {
            // \DB::rollback();
            return Common::getJsonResponse(true, $ex, 200);
        }
    }
    public function getMaxQuote() {
        return QuoteQuote::max('quote_number');
    }

    public function getMaxRevisionNbr($quoteNbr) {
        return QuoteQuote::where('quote_number', $quoteNbr)->max('revision_number');
    }

    public function getMaxQuoteOption($quoteNbr) {
        return QuoteQuote::where('quote_number', $quoteNbr)->max('quote_option');
    }

    public function getMaxItemNbr($quoteId) {
        return QuoteItem::where('quote_id', $quoteId)->max('item_number');
    }

    public function getOpportunityClientInfo($oppInfo) {
        $oppClientInfo = array();
        if ($oppInfo) {
            $oppClientInfo = array(
                "year" => $oppInfo->year,
                "opportunity_nbr" => $oppInfo->project_nbr,
                "opportunity_name" => $oppInfo->name,
                "client_name" => $oppInfo->client->client_name,
                "client_image" => $oppInfo->client->client_image);
            if ($oppInfo->client->clientCommunications->count() > 0) {
                $communication = $oppInfo->client->clientCommunications();
                if ($oppInfo->client->clientCommunications()->ofType('7')->first()) {
                    $oppClientInfo['email'] = $oppInfo->client->clientCommunications()->ofType('7')->first()->communication_value;
                }

                if ($oppInfo->client->clientCommunications()->ofType('1')->first() || $oppInfo->client->clientCommunications()->ofType('2')->first()) {

                    if ($communication->ofType('1')->first())
                        $oppClientInfo['address'] = $oppInfo->client->clientCommunications()->ofType('1')->first()->communication_value;
                    else
                        $oppClientInfo['address'] = $oppInfo->client->clientCommunications()->ofType('2')->first()->communication_value;
                }

                if ($oppInfo->client->clientCommunications()->ofType('5')->first()) {

                    $oppClientInfo['phone'] = $oppInfo->client->clientCommunications()->ofType('5')->first()->communication_value;
                }
            }
        }
        return $oppClientInfo;
    }

    public function getQuotesDetails($quotes) {

        $quoteArray = array();
        foreach ($quotes as $quote) {
            // $quoteRevisions = $this->quotesRepo->getRevisionsByQuoteNbrAndOption($quote->quote_number, $quote->quote_option);
            $quoteInfos = $this->getListByQuoteNbr($quote->quote_number);
            $quoteArray[][$quote->quote_number] = $quoteInfos;
        }
        return $quoteArray;
    }

    /*
     * Get full glass bible for all wind pressures
     * 
     */

    public function getGlassBible() {

        return GlassBible::all();
    }

    public function changeStatus($data) {
        $quote = QuoteQuote::findOrFail($data['quote_id']);
        $quote->quote_status_id_fk=$data['status_id'];
        $quote->save();
        //do quote activity log
        $status_repo=new QuoteStatusRepo;
        $status= $status_repo->getStatusByID($data['status_id']);
        Common::createActivityLog('QUOTE',$quote->id,'STATUS','Status changed to '.$status->status_name,$data['user_name'],$data['notes']);
        return Common::getJsonResponse(true, 'Quote status updated.', 200);
    }
    
    public function addNote($data) {
        $quote = QuoteQuote::findOrFail($data['quote_id']);
        //do quote activity log
        Common::createActivityLog('QUOTE',$quote->id,'NOTE','New note added',$data['user_name'],$data['notes']);
        return Common::getJsonResponse(true, 'New note added.', 200);
    }


        // image upload, update and delete for quote_items



    public function uploadQuoteItemImage(){
        // dd($data);
    //     $rules=array(
    //         'quote_item_id'=>'required',
    //         'filename'=>'mimes:jpg,jpeg,bmp,png,pdf'
    //         );
    //      $validator=Validator::make(Input::all(),$rules);
    // if($validator->fails()){
    //      return Common::getJsonResponse(false, 'Invalid file type!', 500);
    // }
        // dd();
    $file=Input::file('filename');
    // dd($file);
    // $file=Input::all();
    //$file=$_FILES['filename'];
    // dd($file);
    // $file_count=count($file);
   // dd($file_count);
    // $uploadcount=0;
    //dd($file);
    // foreach($file as $f){
     // $random_name=str_random(8);
     // $destinationPath='images/';
     // $extension=$file->getClientOriginalExtension();
     // // dd($extension);
     // $filename=$random_name.'_quote_itm_image.'.$extension;  
     // $byte=File::size($file); //get size of file
     // //dd($byte);
     // $uploadSuccess=Input::file('filename')->move($destinationPath,$filename);
     // $uploadcount ++;

    // }
    // if ($uploadcount == $file_count){
     QuoteItemImage::create(array(
         'quote_item_id'=>Input::get('quote_item_id'),
         'filename'=>$filename,
        'filesize'=>$byte
         ));
     return Common::getJsonResponse(true, 'image created', 200);
        // }
    }

public function updateQuoteItemImage($image){
     $oldimage=QuoteItemImage::findOrFail($image->id);
     // dd($oldimage);
     $image_path  =public_path().'/images/'.$oldimage->filename;
     // dd($image_path);
     // Storage::delete($oldimage);  
      unlink($image_path);                       //deletes existing image from destination folder

     $file=Input::file('filename');
     $random_name=str_random(8);
     $destinationPath='images/';
     $extension=$file->getClientOriginalExtension();
     $filename=$random_name.'_quote_itm_image.'.$extension;  
     $byte=File::size($file); //get size of file
     $uploadSuccess=Input::file('filename')->move($destinationPath,$filename);
     $data=QuoteItemImage::findOrFail($image->id);
     $data->quote_item_id=$image->quote_item_id;
     $data->filename=$filename;
     $data->filesize=$byte;
     $data->save();
 return Common::getJsonResponse(true, 'image updated', 200);


}


public function deleteQuoteItemImage($id){
$data=QuoteItemImage::findOrFail($id);
 $image_path  =public_path().'/images/'.$data->filename;
  unlink($image_path);
$data->delete();
return Common::getJsonResponse(true, 'image deleted', 200);


}

public function updatePaymentOptions($quote){
$data=QuoteQuote::findOrFail($quote->id);
// dd($data);
        $data->rem_pay_1= $quote->rem_pay_1;
        $data->rem_pay_2= $quote->rem_pay_2;
        $data->rem_pay_3= $quote->rem_pay_3;
        $data->rem_pay_4= $quote->rem_pay_4;
        $data->rem_pay_5= $quote->rem_pay_5;
  $data->save();
        return Common::getJsonResponse(true, 'Quote payment option updated successfully !', 200);

}

// Add Item Image ((Working ))
public function addNewItemImage($image){
    // Multiple Files
    $files=Input::file('images');

    $file_count=count($files);

    $uploadcount=0;
    foreach($files as $file){
        $rules=array(
        'image'=>'mimes:jpg,jpeg,bmp,png'
        );
        $validator=Validator::make(array('file'=>$file),$rules);
        if($validator->fails()){
         return Common::getJsonResponse(false, 'Invalid file type!', 500);
        }
        $random_name=str_random(8);
        $extension=$file->getClientOriginalExtension();
        $destinationPath = 'images';
        $filename=$random_name.'_item_image.'.$extension;  
        $byte=filesize($file);
        $file_size = $this->formatSizeUnits($byte);
        $upload_success = $file->move($destinationPath, $filename);
        
        $uploadcount ++;
        
        $data=new QuoteItemImage([
            'quote_item_id'=>$image->quote_item_id,
            'filename'=>$filename,
            'filesize'=>$file_size
            ]);
        $data->save();
    }
    if($uploadcount==$file_count){
        return Common::getJsonResponse(true, 'Quote Item Image Added !', 200);
    }else{
        return Common::getJsonResponse(true, 'Unsuccessfull !!', 500);
    }
}

// Get Item Image
public function getItemImages($id){
    return QuoteItemImage::where('quote_item_id',$id)->get();
}


function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}




//------------------------------------------------------ revisions------------------------------------------


public function revisionfirst($data)
{

    // dd($data);
     $quote = QuoteQuote::with('items')->with('cmsdata')->find($data['id']);
    // // $newQuote =new QuoteQuote()

    // return $quote;
    // dd($quote);
 if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);
        $maxRevNbr = $this->getMaxRevisionNbr($quote->quote_number);
        $newRevNbr = (int) $maxRevNbr + (int) 1;
        $quoteRev = new QuoteQuote();
        try {
            \DB::beginTransaction();

            $data['quote_number'] = $quote->quote_number;
            $data['quote_option'] = $quote->quote_option;
            $data['revision_number'] = $newRevNbr;
            $data['opportunity_id_fk']=$quote->opportunity_id_fk;
            $data['remarks']=$quote->remarks;
            $data['quote_status_id_fk']=$quote->quote_status_id_fk;
            $data['title']=$quote->title;
            $data['total_material_cost']=$quote->total_material_cost;
            $data['total_fabric_install_cost']=$quote->total_fabric_install_cost;
            $data['total_glass_cost']=$quote->total_glass_cost;
            $data['pc_unforseen']=$quote->pc_unforseen;
            $data['pc_engg_mgmt']=$quote->pc_engg_mgmt;
            $data['pc_markup']=$quote->pc_markup;
            $data['pc_glass_markup']=$quote->pc_glass_markup;
            $data['pc_glass_wastage']=$quote->pc_glass_wastage;
            $data['glass_total_markups']=$quote->glass_total_markups;
            $data['total_markup']=$quote->total_markup;
            $data['total_engg_mgmt']=$quote->total_engg_mgmt;
            $data['total_unforeseen']=$quote->total_unforeseen;
            $data['is_include_vat']=$quote->is_include_vat;
            $data['sub_total']=$quote->sub_total;
            $data['discount']=$quote->discount;
            $data['pc_discount']=$quote->pc_discount;
            $data['sub_total_discounted']=$quote->sub_total_discounted;
            $data['vat']=$quote->vat;
            $data['grand_total']=$quote->grand_total;
            $data['product_category_id_fk']=$quote->product_category_id_fk;
            $data['is_glass']=$quote->is_glass;
            $data['infill_type_id_fk']=$quote->infill_type_id_fk;
            $data['infill_thickness_id_fk']=$quote->infill_thickness_id_fk;
            $data['created_by']=$quote->created_by;
            $data['updated_by']=$quote->updated_by;
            $data['deleted_by']=$quote->deleted_by;
            $data['wind_pressure']=$quote->wind_pressure;
            $data['rem_pay_1']=$quote->rem_pay_1;
            $data['rem_pay_2']=$quote->rem_pay_2;
            $data['rem_pay_3']=$quote->rem_pay_3;
            $data['rem_pay_4']=$quote->rem_pay_4;
            $data['rem_pay_5']=$quote->rem_pay_5;

            $quoteitemData=$quote->items->toArray();
            // dd($quoteitemData);
            // $quoteOpportunityData=$quote->quoteOpportunity->toArray();
            $quoteCMSData=$quote->cmsdata->toArray();
            // dd($quoteOpportunityData);
            $quoteRev->fill($data)->save();

            foreach ($quoteitemData as $key =>$value){
                    $quoteitemData[$key]['quote_id']=$quoteRev->id;
                    $quoteitemData[$key]['id']=null;
            }

            // foreach ($quoteOpportunityData as $key =>$value){
            //         $quoteOpportunityData[$key]['quote_id']=$quoteRev->id;
            //         $quoteOpportunityData[$key]['id']=null;
            // }
            foreach ($quoteCMSData as $key =>$value){
                    $quoteCMSData[$key]['quote_id']=$quoteRev->id;
                    $quoteCMSData[$key]['id']=null;
            }
              // foreach ($templateSettings as $setting) {
              //       $itemTemplateSetting = new QuoteItemTemplateSetting();
              //       $setting['quote_item_template_id_fk'] = $itemTemplate->id;
              //       $itemTemplateSetting->fill($setting)->save();
              //   }

            \DB::table('quote_items')->insert($quoteitemData);
            // \DB::table('quote_template_profiles')->insert($profilesData);
            \DB::table('quote_cms_data')->insert($quoteCMSData);


            \DB::commit();
            return Common::getJsonResponse(true, 'Quote revision added successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }

}





public function revisionsecond($data)

{



    // dd($data);
     $quote = QuoteQuote::with('items')->with('cmsdata')->find($data['id']);
    // // $newQuote =new QuoteQuote()
// 
    // return $quote;
    // dd($quote);
 if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);
        // $maxRevNbr = $this->getMaxRevisionNbr($quote->quote_number);
        // $newRevNbr = (int) $maxRevNbr + (int) 1;
          $maxQuote = $this->getMaxQuote();
        if ($maxQuote)
            $newQuoteNbr = (int) $maxQuote + (int) 1;
        else
            $newQuoteNbr = config('quotes.QUOTE_START');

        $quoteRev = new QuoteQuote();
        try {
            \DB::beginTransaction();

            // $data['quote_number'] = $quote->$newQuoteNbr;
             $data['quote_number'] = $newQuoteNbr;
            $data['quote_option'] = $quote->quote_option;
            $data['revision_number'] = '0';
            $data['opportunity_id_fk']=$quote->opportunity_id_fk;
            $data['remarks']=$quote->remarks;
            $data['quote_status_id_fk']=$quote->quote_status_id_fk;
            $data['title']=$quote->title;
            $data['total_material_cost']=$quote->total_material_cost;
            $data['total_fabric_install_cost']=$quote->total_fabric_install_cost;
            $data['total_glass_cost']=$quote->total_glass_cost;
            $data['pc_unforseen']=$quote->pc_unforseen;
            $data['pc_engg_mgmt']=$quote->pc_engg_mgmt;
            $data['pc_markup']=$quote->pc_markup;
            $data['pc_glass_markup']=$quote->pc_glass_markup;
            $data['pc_glass_wastage']=$quote->pc_glass_wastage;
            $data['glass_total_markups']=$quote->glass_total_markups;
            $data['total_markup']=$quote->total_markup;
            $data['total_engg_mgmt']=$quote->total_engg_mgmt;
            $data['total_unforeseen']=$quote->total_unforeseen;
            $data['is_include_vat']=$quote->is_include_vat;
            $data['sub_total']=$quote->sub_total;
            $data['discount']=$quote->discount;
            $data['pc_discount']=$quote->pc_discount;
            $data['sub_total_discounted']=$quote->sub_total_discounted;
            $data['vat']=$quote->vat;
            $data['grand_total']=$quote->grand_total;
            $data['product_category_id_fk']=$quote->product_category_id_fk;
            $data['is_glass']=$quote->is_glass;
            $data['infill_type_id_fk']=$quote->infill_type_id_fk;
            $data['infill_thickness_id_fk']=$quote->infill_thickness_id_fk;
            $data['created_by']=$quote->created_by;
            $data['updated_by']=$quote->updated_by;
            $data['deleted_by']=$quote->deleted_by;
            $data['wind_pressure']=$quote->wind_pressure;
            $data['rem_pay_1']=$quote->rem_pay_1;
            $data['rem_pay_2']=$quote->rem_pay_2;
            $data['rem_pay_3']=$quote->rem_pay_3;
            $data['rem_pay_4']=$quote->rem_pay_4;
            $data['rem_pay_5']=$quote->rem_pay_5;

            $quoteitemData=$quote->items->toArray();
            // dd($quoteitemData);
            // $quoteOpportunityData=$quote->quoteOpportunity->toArray();
            $quoteCMSData=$quote->cmsdata->toArray();
            // dd($quoteOpportunityData);
            $quoteRev->fill($data)->save();

            foreach ($quoteitemData as $key =>$value){
                    $quoteitemData[$key]['quote_id']=$quoteRev->id;
                    $quoteitemData[$key]['id']=null;
            }

            // foreach ($quoteOpportunityData as $key =>$value){
            //         $quoteOpportunityData[$key]['quote_id']=$quoteRev->id;
            //         $quoteOpportunityData[$key]['id']=null;
            // }
            foreach ($quoteCMSData as $key =>$value){
                    $quoteCMSData[$key]['quote_id']=$quoteRev->id;
                    $quoteCMSData[$key]['id']=null;
            }
              // foreach ($templateSettings as $setting) {
              //       $itemTemplateSetting = new QuoteItemTemplateSetting();
              //       $setting['quote_item_template_id_fk'] = $itemTemplate->id;
              //       $itemTemplateSetting->fill($setting)->save();
              //   }

            \DB::table('quote_items')->insert($quoteitemData);
            // \DB::table('quote_template_profiles')->insert($profilesData);
            \DB::table('quote_cms_data')->insert($quoteCMSData);


            \DB::commit();
            return Common::getJsonResponse(true, 'Quote revision added successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }

   
}


public function getquotelist(){

    $quotes=QuoteQuote::select('id','quote_number','title')->get();
    return $quotes;

}



public function revisionthird($data,$destination)
{



    // dd($data);
     $quote = QuoteQuote::with('items')->with('cmsdata')->find($data['id']);
    // // $newQuote =new QuoteQuote()
// 
    // return $quote;
    // dd($quote);
 if (!$quote)
            return Common::getJsonResponse(false, 'Quote does not exist.', 200);
        // $maxRevNbr = $this->getMaxRevisionNbr($quote->quote_number);
        // $newRevNbr = (int) $maxRevNbr + (int) 1;
          $maxQuote = $this->getMaxQuote();
        if ($maxQuote)
            $newQuoteNbr = (int) $maxQuote + (int) 1;
        else
            $newQuoteNbr = config('quotes.QUOTE_START');

        $quoteRev = new QuoteQuote();
        try {
            \DB::beginTransaction();

            // $data['quote_number'] = $quote->$newQuoteNbr;
             $data['quote_number'] = $newQuoteNbr;
            $data['quote_option'] = $quote->quote_option;
            $data['revision_number'] = '0';
            $data['opportunity_id_fk']=$quote->opportunity_id_fk;
            $data['remarks']=$quote->remarks;
            $data['quote_status_id_fk']=$quote->quote_status_id_fk;
            $data['title']=$quote->title;
            $data['total_material_cost']=$quote->total_material_cost;
            $data['total_fabric_install_cost']=$quote->total_fabric_install_cost;
            $data['total_glass_cost']=$quote->total_glass_cost;
            $data['pc_unforseen']=$quote->pc_unforseen;
            $data['pc_engg_mgmt']=$quote->pc_engg_mgmt;
            $data['pc_markup']=$quote->pc_markup;
            $data['pc_glass_markup']=$quote->pc_glass_markup;
            $data['pc_glass_wastage']=$quote->pc_glass_wastage;
            $data['glass_total_markups']=$quote->glass_total_markups;
            $data['total_markup']=$quote->total_markup;
            $data['total_engg_mgmt']=$quote->total_engg_mgmt;
            $data['total_unforeseen']=$quote->total_unforeseen;
            $data['is_include_vat']=$quote->is_include_vat;
            $data['sub_total']=$quote->sub_total;
            $data['discount']=$quote->discount;
            $data['pc_discount']=$quote->pc_discount;
            $data['sub_total_discounted']=$quote->sub_total_discounted;
            $data['vat']=$quote->vat;
            $data['grand_total']=$quote->grand_total;
            $data['product_category_id_fk']=$quote->product_category_id_fk;
            $data['is_glass']=$quote->is_glass;
            $data['infill_type_id_fk']=$quote->infill_type_id_fk;
            $data['infill_thickness_id_fk']=$quote->infill_thickness_id_fk;
            $data['created_by']=$quote->created_by;
            $data['updated_by']=$quote->updated_by;
            $data['deleted_by']=$quote->deleted_by;
            $data['wind_pressure']=$quote->wind_pressure;
            $data['rem_pay_1']=$quote->rem_pay_1;
            $data['rem_pay_2']=$quote->rem_pay_2;
            $data['rem_pay_3']=$quote->rem_pay_3;
            $data['rem_pay_4']=$quote->rem_pay_4;
            $data['rem_pay_5']=$quote->rem_pay_5;

            $quoteitemData=$quote->items->toArray();
            // dd($quoteitemData);
            // $quoteOpportunityData=$quote->quoteOpportunity->toArray();
            $quoteCMSData=$quote->cmsdata->toArray();
            // dd($quoteOpportunityData);
            $quoteRev->fill($data)->save();

            foreach ($quoteitemData as $key =>$value){
                    $quoteitemData[$key]['quote_id']=$quoteRev->id;
                    $quoteitemData[$key]['id']=null;
            }

            // foreach ($quoteOpportunityData as $key =>$value){
            //         $quoteOpportunityData[$key]['quote_id']=$quoteRev->id;
            //         $quoteOpportunityData[$key]['id']=null;
            // }
            foreach ($quoteCMSData as $key =>$value){
                    $quoteCMSData[$key]['quote_id']=$quoteRev->id;
                    $quoteCMSData[$key]['id']=null;
            }
              // foreach ($templateSettings as $setting) {
              //       $itemTemplateSetting = new QuoteItemTemplateSetting();
              //       $setting['quote_item_template_id_fk'] = $itemTemplate->id;
              //       $itemTemplateSetting->fill($setting)->save();
              //   }

            \DB::table('quote_items')->insert($quoteitemData);
            // \DB::table('quote_template_profiles')->insert($profilesData);
            \DB::table('quote_cms_data')->insert($quoteCMSData);


            \DB::commit();
            return Common::getJsonResponse(true, 'Quote revision added successfully !', 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return Common::getJsonResponse(true, $e->getMessage(), 300);
        }





}




}
