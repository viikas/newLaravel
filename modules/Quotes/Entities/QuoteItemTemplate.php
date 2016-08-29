<?php namespace Modules\Quotes\Entities;
   
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplate extends Model {
  protected $table = 'quote_item_template';
  protected $fillable = [
    'id',
    'quote_item_id_fk',
    'template_code',
    'template_type',
    'material_cost',
    'fabrication_cost',
    'glass_cost'
  ];

  public function itemTemplateSettings()
  {
    return $this->hasMany('Modules\Quotes\Entities\QuoteItemTemplateSetting', 'quote_item_template_id_fk');
  }

  public function itemTemplateProfiles()
  {
    return $this->hasMany('Modules\Quotes\Entities\QuoteItemTemplateProfile', 'quote_item_template_id_fk');
  }

  public function itemTemplateAccessories()
  {
    return $this->hasMany('Modules\Quotes\Entities\QuoteItemTemplateAccessory', 'quote_item_template_id_fk');
  }
  public function itemTemplateInfill()
  {
     return $this->hasMany('Modules\Quotes\Entities\ItemTemplateInfilling', 'quote_item_template_id_fk');
  }
}