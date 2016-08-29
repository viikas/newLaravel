<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class ItemTemplateInfilling extends Model {
	protected $table = 'quote_item_template_infilling';
    protected $fillable = ['quote_item_template_id_fk','is_fixed','panel_count','length_formula','height_formula','length_mm','height_mm','infill_area_sqft','actual_infill_area','	bible_suggested','is_glass','infill_type_id_fk','infill_thickness_id_fk','infill_unit_cost','infill_total_cost'];

}