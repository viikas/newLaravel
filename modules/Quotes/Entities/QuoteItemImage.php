<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteItemImage extends Model {
	protected $table='quote_item_images';
    protected $fillable = [
    'quote_item_id',
    'filename',
    'filesize',
    'created_by'


    ];


     public function quoteitems()
  {
    return $this->belongTo('Modules\Quotes\Entities\QuoteItem', 'quote_item_id');
  }


}