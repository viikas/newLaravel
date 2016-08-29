<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model {
protected $table='product_category';
    protected $fillable = [
   'name'

];

public function profile(){
	$this->hasMany('Modules\Quotes\Entities\QuoteProfileModel','category_id');



}


}