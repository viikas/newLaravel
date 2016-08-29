<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	protected $table='imagetable';
    protected $fillable = ['image','description'];

}