<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateSetting extends Model {
  protected $table = 'quote_item_template_setting';
  protected $fillable = [

    'id',
    'quote_item_template_id_fk',
    'field_code',
    'field_name',
    'field_value',
    'acc_ref',
    'field_data_type',
    'formula',
    'qty_length',
    'mu_cost_rs',
    'total_price'
  ];

}