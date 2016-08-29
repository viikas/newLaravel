<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class AdditionalAccessories extends Model {
	protected $table='quote_additional_accessories';
    protected $fillable = ['accessory_category_name','accessory_code','accessory_name','remarks','created_at','updated_at','is_length'];



public  function additional_accessories_price(){
     return $this->hasMany('Modules\Quotes\Entities\AdditionalAccessoriesPriceRevision','quote_additional_acccessory_id');
   }
}