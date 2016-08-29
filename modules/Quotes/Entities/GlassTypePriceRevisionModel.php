<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class GlassTypePriceRevisionModel extends Model {
	 protected $table = 'quote_glass_price_revision';
    protected $fillable = [
    'quote_glass_type_thickness_id_fk',
    'inventory_price',
    'revised_price',
    'effective_date',
    'deleted',
    'user',
    'remark',
    'created_at',
    'updated_at',
    'is_changed'


    ];

}