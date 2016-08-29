<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class ProductPriceRevision extends Model {
    protected $table = "quote_product_price_revision";
    protected $fillable = ["product_id","invent_price","revised_price","effictive_date","deleted","user","remark","is_changed"];


 public function accessory()
      {
         return $this->belongsTo('Modules\Quotes\Entities\InventoryAccessories','product_id');
     }




         
}