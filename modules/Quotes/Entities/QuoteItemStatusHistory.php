<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Quote_item_status_history extends Model {

    protected $fillable = [

'id',
'quote_item_id_fk',
'quote_status_id_fk',
'remarks',
'created_by',
'assigned_to'
    ];

}