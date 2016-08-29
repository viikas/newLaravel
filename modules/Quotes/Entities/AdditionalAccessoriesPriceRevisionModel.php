<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class AdditionalAccessoriesPriceRevisionModel extends Model {
	protected $table='quote_additional_accessories_price_revision';
    protected $fillable = [
'quote_additional_accessory_id',
'revised_price',
'effective_date',
'deleted',
'user',
'remark',
'is_changed'

    ];

}