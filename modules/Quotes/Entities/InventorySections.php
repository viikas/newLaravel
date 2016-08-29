<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class InventorySections extends Model {
    protected $table = 'invent_section';
    protected $fillable = ["brand_id","number","section_type_id","weight","thickness","vol_page","notes","attachment","deleted"];


  
}