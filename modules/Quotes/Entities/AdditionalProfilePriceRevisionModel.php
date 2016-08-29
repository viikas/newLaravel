<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class AdditionalProfilePriceRevisionModel extends Model {
	protected $table='quote_additional_profiles_price_revision';
    protected $fillable = [
    'quote_additional_profile_id',
    'revised_price',
    'effective_date',
    'deleted',
    'user',
    'remark'
    ];

}