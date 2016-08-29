<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class BoardModel extends Model {
	protected $table='quote_board_types';
    protected $fillable = [

    'type',
    'remarks'

    ];
public function boardthickness(){
 return $this->hasMany('Modules\Quotes\Entities\BoardThicknessModel','quote_board_type_id_fk')->select('id','quote_board_type_id_fk','thickness');

}
}