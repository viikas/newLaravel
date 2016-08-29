<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class GlassTypeThicknessModel extends Model {
	protected $table = 'quote_glass_type_thickness';
    protected $fillable = [
    'quote_glass_type_id_fk',
    'thickness'

    ];

}