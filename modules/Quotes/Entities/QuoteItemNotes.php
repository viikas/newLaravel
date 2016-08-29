<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Quote_item_notes extends Model {

    protected $fillable = [
'id',
'quote_item_id_fk',
'note',
'is_task_created',
'created_by'


    ];

}