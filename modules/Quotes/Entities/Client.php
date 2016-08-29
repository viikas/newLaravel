<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    protected $table = 'client';
    protected $fillable = [];

    /*
    * client communications
    */
    public function clientCommunications()
    {
        return $this->hasMany('Modules\Quotes\Entities\ClientCommunication');
    }

    /*
    * client addresses
    */
    public function clientAddresses()
    {
        return $this->hasMany('Modules\Quotes\Entities\ClientAddress');
    }
}