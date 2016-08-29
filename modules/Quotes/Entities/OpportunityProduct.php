<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class OpportunityProduct extends Model {

    protected $fillable = [];
    protected $table = 'opportunity_product';

  public static function listProductsByOppId($oppId) {
    return OpportunityProduct::where('opportunity_id', $oppId);
  }
}