<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class CMSData extends Model {
	protected $table='quote_cms_data';
    protected $fillable = ['quote_id','cms_code','field_value'];





  public function quotes()
  {
    return $this->belongsTo('Modules\Quotes\Entities\QuoteQuote','quote_id');

  }

}