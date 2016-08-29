<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model {
  protected $table = 'opportunity';
  protected $fillable = [];

  public function client()
  {
      return $this->belongsTo('Modules\Quotes\Entities\Client');
  }

  public function quotes()
  {
      return $this->hasMany('Modules\Quotes\Entities\QuoteQuote');
  }
}