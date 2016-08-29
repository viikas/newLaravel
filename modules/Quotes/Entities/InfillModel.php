<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class InfillModel extends Model {
	protected $table='quote_template_infilling';
    protected $fillable = ['quote_template_id_fk','is_fixed','panel_count','length_formula','height_formula','height_formula','length_mm','height_mm'];


 // public function details()
 //    {
 //        return $this->belongsTo('Modules\Quotes\Entities\InventoryAccessories','accessory_id_fk');
 //    }
}