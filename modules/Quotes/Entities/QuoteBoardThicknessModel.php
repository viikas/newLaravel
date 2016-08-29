<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteBoardThicknessModel extends Model {
	protected $table = 'quote_board_types_thickness';
    protected $fillable = [
    'id',
    'quote_board_type_id_fk',
    'thickness',
    'created_at',
    'updated_at'

    ];

}