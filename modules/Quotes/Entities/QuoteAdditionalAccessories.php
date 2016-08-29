<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteAdditionalAccessories extends Model {
 protected $table = 'quote_additional_accessories';
    protected $fillable = [
    'accessory_category_name',
        'accessory_code',
        'accessory_name',
        'remarks',
        'is_length'


    ];

}