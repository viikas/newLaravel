<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateAccessory extends Model {

  protected $fillable = [

    'id',
    'quote_item_template_id_fk',
    'acc_ref',
    'description',
    'formula',
    'qty_length',
    'mu_cost_rs',
    'total_price'
  ];

}