<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $table = 'product';
  protected $fillable = [];

  public function productModels()
  {
      return $this->hasMany('Modules\Quotes\Entities\ProductModel')->whereNull('deleted');
  }
}