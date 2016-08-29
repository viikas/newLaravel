<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteProfileModel extends Model {
	protected $table='quote_profiles';
    protected $fillable = [
    'category_id',
    'color_type',
    'profile_color'



    ];

}