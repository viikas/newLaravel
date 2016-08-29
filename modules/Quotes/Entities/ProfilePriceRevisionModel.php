<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class ProfilePriceRevisionModel extends Model {
	Protected $table='quote_profiles_price_revision';
    protected $fillable = [
    'id',
    'quote_profile_id',
    'revised_price',
    'inventory_price',
    'effective_date',
    'deleted',
    'user',
    'remarks',
    'created_at',
    'updated_at',
    'is_changed'


    ];

}