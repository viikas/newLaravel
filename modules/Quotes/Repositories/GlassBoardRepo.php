<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\GlassBoardInterface;
use Modules\Quotes\Entities\GlassTypePriceRevisionModel;
use Modules\Quotes\Entities\BoardTypePriceRevisionModel;
use Modules\Quotes\Repositories\Common\Common;
use Modules\Quotes\Entities\BoardThicknessModel;
use Modules\Quotes\Entities\GlassBible;
class GlassBoardRepo implements GlassBoardInterface {

    public function getGlassTypes() {
        // $glass=\DB::table('quote_glass_types')
        //   ->join('quote_glass_type_thickness','quote_glass_types.id','=','quote_glass_type_thickness.quote_glass_type_id_fk')
        //   //->select('quote_glass_type_thickness.id','name','thickness','parent_id as glass_type')
        // // ->select(\DB::raw("'quote_glass_type_thickness.id,name,thickness,parent_id'as a"))
        //   ->get();
        //   return $glass;
// $accessories=\DB::table(\DB::raw("(SELECT * FROM quote_product_price_revision a WHERE created_at=(SELECT max(created_at) FROM quote_product_price_revision b WHERE a.product_id=b.product_id)ORDER BY product_id ASC)as AccessoryRevision"))
//                 ->join('invent_accessory','invent_accessory.id','=','AccessoryRevision.product_id')
//                  ->select('invent_accessory.id', 'code', 'sl_detail', 'invent_price','revised_price','created_at')
//               ->get();
//$data1=DB::select(DB::raw("SELECT accessory_code_id,color_id,rate,created_date FROM invent_requisition_accessory a WHERE created_date=(SELECT max(created_date) FROM invent_requisition_accessory b WHERE a.accessory_code_id=b.accessory_code_id)ORDER BY accessory_code_id ASC"));
        $glass = \DB::table(\DB::raw("(SELECT  b.id,a.name as glass_type,b.name FROM quote_glass_types as a LEFT JOIN quote_glass_types as b ON a.id=b.parent_id)as glass"))
                ->join('quote_glass_type_thickness', 'glass.id', '=', 'quote_glass_type_thickness.quote_glass_type_id_fk')
                ->select('quote_glass_type_thickness.id', 'name', 'glass_type', 'thickness')
                ->get();

        return $glass;
    }

    public function getLatestGlasstypeRevision() {
        $glass = \DB::table(\DB::raw("(SELECT  b.id,a.name as glass_type,b.name FROM quote_glass_types as a LEFT JOIN quote_glass_types as b ON a.id=b.parent_id)as glass"))
                ->join('quote_glass_type_thickness', 'glass.id', '=', 'quote_glass_type_thickness.quote_glass_type_id_fk')
                ->join('quote_glass_price_revision', 'quote_glass_type_thickness.id', '=', 'quote_glass_price_revision.quote_glass_type_thickness_id_fk')
                ->select('quote_glass_price_revision.id','quote_glass_price_revision.is_changed','quote_glass_price_revision.quote_glass_type_thickness_id_fk', 'name', 'glass_type', 'thickness', 'inventory_price', 'revised_price', 'effective_date', 'deleted', 'user', 'remark', 'quote_glass_price_revision.created_at')
                ->orderBy('quote_glass_price_revision.created_at', 'desc')
                ->get();

        $array = json_decode(json_encode($glass, true));
        $collection = collect($array);
        //dd($collection);
        $grouped = $collection->groupBy('created_at');

        return $grouped;
    }

    public function getGlassTypeRevisionByDate($date) {

        $date_array = explode(',', $date);
        $revision = \DB::table('quote_glass_types')
                ->join('quote_glass_type_thickness', 'quote_glass_types.id', '=', 'quote_glass_type_thickness.quote_glass_type_id_fk')
                ->join('quote_glass_price_revision', 'quote_glass_type_thickness.id', '=', 'quote_glass_price_revision.quote_glass_type_thickness_id_fk')
                ->select('quote_glass_types.id', 'name', 'parent_id', 'thickness', 'inventory_price', 'revised_price', 'effective_date', 'deleted', 'user', 'remark', 'quote_glass_price_revision.updated_at')
                ->orderBy('updated_at', 'desc')
                ->get();
        //	return $revision;

        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
//dd($collection);
        $grouped = $collection->groupBy('updated_at');

        return $grouped;
    }

    public function getBoards() {
        $boards = \DB::table('quote_board_types')
                ->join('quote_board_type_thickness', 'quote_board_type_thickness.quote_board_type_id_fk', '=', 'quote_board_types.id')
                ->select('quote_board_type_thickness.id', 'type', 'remarks', 'thickness')
                ->get();

        return $boards;
    }

    public function getAllGlassAndBoards() {
        $glasses = \DB::table(\DB::raw("(SELECT  b.id,a.name as glass_type,b.name FROM quote_glass_types as a LEFT JOIN quote_glass_types as b ON a.id=b.parent_id)as glass"))
                ->join('quote_glass_type_thickness', 'glass.id', '=', 'quote_glass_type_thickness.quote_glass_type_id_fk')
                ->select('quote_glass_type_thickness.id', 'name', 'glass_type', 'thickness')
                ->get();

        $boards = \DB::table('quote_board_types')
                ->join('quote_board_type_thickness', 'quote_board_type_thickness.quote_board_type_id_fk', '=', 'quote_board_types.id')
                ->select('quote_board_type_thickness.id', 'type', 'remarks', 'thickness')
                ->get();
        //dd($boards);
        //dd($glasses);
        $std = new \stdClass();
        $std->glass = $glasses;
        $std->board = $boards;
        return $std;
    }

    public function getLatestBoardRevisionPrice() {

        $revision = \DB::table('quote_board_types')
                ->join('quote_board_type_thickness', 'quote_board_types.id', '=', 'quote_board_type_thickness.quote_board_type_id_fk')
                ->join('quote_board_price_revision', 'quote_board_type_thickness.id', '=', 'quote_board_price_revision.quote_board_type_thickness_id_fk')
                ->select('quote_board_price_revision.id','quote_board_price_revision.is_changed', 'quote_board_type_thickness_id_fk', 'type', 'thickness', 'inventory_price', 'revised_price', 'effective_date', 'deleted', 'user', 'remark', 'quote_board_price_revision.created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        //	return $revision;
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
//dd($collection);
        $grouped = $collection->groupBy('created_at');


        return $grouped;
    }

    public function getBoardTypeRevisionByDate($date) {

        $date_array = explode(',', $date);
        $revision = \DB::table('quote_board_types')
                ->join('quote_board_type_thickness', 'quote_board_types.id', '=', 'quote_board_type_thickness.quote_board_type_id_fk')
                ->join('quote_board_price_revision', 'quote_board_type_thickness.id', '=', 'quote_board_price_revision.quote_board_type_thickness_id_fk')
                ->select('quote_board_types.id', 'type', 'thickness', 'inventory_price', 'revised_price', 'effective_date', 'deleted', 'user', 'remark', 'quote_board_price_revision.updated_at')
                ->orderBy('updated_at', 'desc')
                ->get();
        $array = json_decode(json_encode($revision, true));
        $collection = collect($array);
//dd($collection);
        $grouped = $collection->groupBy('updated_at');


        return $grouped;
    }

    public function updateGlassTypeRevision($glassPrice) {

        $data = GlassTypePriceRevisionModel::findorFail($glassPrice->id);

        $data->quote_glass_type_thickness_id_fk = $glassPrice->quote_glass_type_thickness_id_fk;
        $data->inventory_price = $glassPrice->inventory_price;
        $data->revised_price = $glassPrice->revised_price;
        $data->effective_date = $glassPrice->effective_date;
        $data->deleted = $glassPrice->deleted;
        $data->user = $glassPrice->user;
        $data->remark = $glassPrice->remark;
        $data->is_changed = $glassPrice->is_changed;
        $data->save();
        return Common::getJsonResponse(true, 'pricerevision updated successfully !', 200);
    }

    public function addBulkGlassRevision($bulkGlass) {
        foreach ($bulkGlass as $glass) {

            $PriceRevision = new GlassTypePriceRevisionModel(
                    [
                'quote_glass_type_thickness_id_fk' => $glass->quote_glass_type_thickness_id_fk,
                'inventory_price' => $glass->inventory_price,
                'revised_price' => $glass->revised_price,
                'effective_date' => $glass->effective_date,
                'deleted' => $glass->deleted,
                'user' => $glass->user,
                'remark' => $glass->remark,
                'is_changed'=>$glass->is_changed,
                    ]
            );
            $PriceRevision->save();
        }


        return Common::getJsonResponse(true, 'GLass Price Revision added successfully !', 200);
    }

    public function updateBoardTypeRevision($boardPrice) {

        $data = BoardTypePriceRevisionModel::findorFail($boardPrice->id);

        $data->quote_board_type_thickness_id_fk = $boardPrice->quote_board_type_thickness_id_fk;
        $data->inventory_price = $boardPrice->inventory_price;
        $data->revised_price = $boardPrice->revised_price;
        $data->effective_date = $boardPrice->effective_date;
        $data->deleted = $boardPrice->deleted;
        $data->user = $boardPrice->user;
        $data->remark = $boardPrice->remark;
        $data->is_changed = $boardPrice->is_changed;
        $data->save();
        return Common::getJsonResponse(true, 'pricerevision updated successfully !', 200);
    }

    public function addBulkBoardRevision($bulkBoard) {
        foreach ($bulkBoard as $board) {

            $PriceRevision = new BoardTypePriceRevisionModel(
                    [
                'quote_board_type_thickness_id_fk' => $board->quote_board_type_thickness_id_fk,
                'inventory_price' => $board->inventory_price,
                'revised_price' => $board->revised_price,
                'effective_date' => $board->effective_date,
                'deleted' => $board->deleted,
                'user' => $board->user,
                'remark' => $board->remark,
                'is_changed' => $board->is_changed,
                    ]
            );
            $PriceRevision->save();
        }


        return Common::getJsonResponse(true, 'Board Price Revision added successfully !', 200);
    }
    
    /*
     * Get full glass bible for all wind pressures
     * 
     */
    public function getGlassBible() {

        return GlassBible::all();
    }
    
    /***
     * Get latest glass and board price for each thickness
     */
    public function getGlassAndBoardPrice() {

        $board_price = \DB::table('quote_board_types')
                ->join('quote_board_type_thickness', 'quote_board_types.id', '=', 'quote_board_type_thickness.quote_board_type_id_fk')
                ->join('quote_board_price_revision', 'quote_board_type_thickness.id', '=', 'quote_board_price_revision.quote_board_type_thickness_id_fk')
                ->select('quote_board_type_thickness_id_fk', 'type', 'thickness', 'revised_price')
                ->where('deleted', null)
                ->get();
        
        $glass_price = \DB::table(\DB::raw("(SELECT  b.id,a.name as glass_type,b.name FROM quote_glass_types as a LEFT JOIN quote_glass_types as b ON a.id=b.parent_id)as glass"))
                ->join('quote_glass_type_thickness', 'glass.id', '=', 'quote_glass_type_thickness.quote_glass_type_id_fk')
                ->join('quote_glass_price_revision', 'quote_glass_type_thickness.id', '=', 'quote_glass_price_revision.quote_glass_type_thickness_id_fk')
                ->select('quote_glass_type_thickness.id', 'name', 'glass_type', 'thickness', 'revised_price')
                ->where('deleted', null)
                ->get();
        
        $data = new \stdClass();
        $data->board_price = $board_price;
        $data->glass_price = $glass_price;
        return $data;
    }

}
