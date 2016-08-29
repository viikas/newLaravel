<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateProfile extends Model {
    protected $table='quote_item_template_profiles';
  protected $fillable = [

    'id',
    'quote_item_template_id_fk',
    'aluminium',
    'description',
    'formula',
    'quantity',
    'qty_length',
    'kg_meter',
    'amount'
  ];

}