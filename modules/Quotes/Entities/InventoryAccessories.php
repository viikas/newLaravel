<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class InventoryAccessories extends Model {
    protected $table = 'invent_accessory';
    protected $fillable = ["brand_id","code","coo","mn_detail","sl_detail","color_id","unit_id","length","sec_unit_id","is_lenght","created_date","created_by","deleted","price_revision_id_fk"];


public function revision(){
 return $this->hasMany('Modules\Quotes\Entities\ProductPriceRevision','product_id');

}
// public function pricerevision()
//     {
//         return $this->belongsTo('Modules\Quotes\Entities\ProductPriceRevision','product_id');
//     }

   
}