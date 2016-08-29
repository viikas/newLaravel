<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class BoardThicknessModel extends Model {
	protected $table='quote_board_type_thickness';
    protected $fillable = [
    'quote_board_type_id_fk',
    'thickness'
    ];

}