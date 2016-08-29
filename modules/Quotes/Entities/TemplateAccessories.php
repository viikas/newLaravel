<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class TemplateAccessories extends Model {
    protected $table = 'quote_template_accessories';
    protected $fillable = ["quote_template_id_fk","accessory_id_fk","formula","is_roller","qty_length","is_length","is_additional"];
    public $timestamps = false;
    public function price()
    {
        return $this->belongsTo('Modules\Quotes\Entities\ProductPriceRevision','accessory_id_fk','product_id');
    }
    public function details()
    {
        return $this->belongsTo('Modules\Quotes\Entities\InventoryAccessories','accessory_id_fk','id');
    }
    public function price1()
    {
        return $this->belongsTo('Modules\Quotes\Entities\AdditionalAccessoriesPriceRevision','accessory_id_fk','quote_additional_accessory_id');
    }
    public function details1()
    {
        return $this->belongsTo('Modules\Quotes\Entities\AdditionalAccessories','accessory_id_fk','id');
    }
       
}