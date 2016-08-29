<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class AdditionalProfiles extends Model {
     protected $table = 'quote_additional_profile';
    protected $fillable = ['profile_category_name','number','profile_name','weight','thickness','notes'];
}