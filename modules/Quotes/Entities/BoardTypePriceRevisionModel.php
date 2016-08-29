<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class BoardTypePriceRevisionModel extends Model {
	 protected $table = "quote_board_price_revision";
    protected $fillable = [
    'quote_board_type_thickness_id_fk',
    'revised_price',
    'inventory_price',
    'effective_date',
    'deleted',
    'user',
    'remark',
    'created_at',
    'updated_at',
    'is_changed'


    ];

}