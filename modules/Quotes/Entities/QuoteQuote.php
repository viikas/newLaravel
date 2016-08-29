<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteQuote extends Model {

  protected $fillable = [

    'opportunity_id_fk',
    'quote_number',
    'quote_option',
    'revision_number',
    'title',
    'remarks',
    'quote_status_id_fk',
    'total_material_cost',
    'total_fabric_install_cost',
    'total_glass_cost',
    'pc_unforseen',
    'pc_engg_mgmt',
    'pc_markup',
    'pc_glass_markup',
    'pc_glass_wastage',
    'glass_total_markups',
    'total_markup',
    'total_engg_mgmt',
    'total_unforeseen',
    'is_include_vat',
    'sub_total',
    'discount',
    'pc_discount',
    'sub_total_discounted',
    'vat',
    'grand_total',
    'product_category_id_fk',
    'is_glass',
    'infill_type_id_fk',
    'infill_thickness_id_fk',
    'created_by',
    'updated_by',
    'deleted_by',
    'deleted_at',
    'wind_pressure',
    'rem_pay_1',
    'rem_pay_2',
    'rem_pay_3',
    'rem_pay_4',
    'rem_pay_5'

  ];

  public function items()
  {
    return $this->hasMany('Modules\Quotes\Entities\QuoteItem', 'quote_id');
  }

  public function quoteOpportunity()
  {
    return $this->belongsTo('Modules\Quotes\Entities\Opportunity', 'opportunity_id_fk')->join('project_type','project_type.id','=','opportunity.project_type_id')->select('opportunity.id','project_type.name');
  }


  public function cmsdata()
  {
    return $this->hasMany('Modules\Quotes\Entities\CMSData','quote_id');

  }


}