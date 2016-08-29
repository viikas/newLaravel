<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class ClientCommunication extends Model {
  protected $table = 'client_communication';
  protected $fillable = [];

  public function scopeOfType($query, $type)
  {
    return $query->where('communication_type_id', $type)->whereNull('deleted');
  }
}