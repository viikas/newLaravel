<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class GlassTypeModel extends Model {
	protected $table = 'quote_glass_types';
    protected $fillable = [
'name',
'parent_id'
    ];

public function glassparent(){
return $this->belongsTo('Modules\Quotes\Entities\GlassTypeModel','parent_id')->select('id','name');
}


public function glassthickness(){
 return $this->hasMany('Modules\Quotes\Entities\GlassTypeThicknessModel','quote_glass_type_id_fk')->select('id','quote_glass_type_id_fk','thickness');

}
}