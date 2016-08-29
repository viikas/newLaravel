<?php namespace Modules\Quotes\Entities;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model {

    protected $fillable = [
        
        'quote_id',
        'item_number',
        'description',
        'size',
        'quantity',
        'square_ft',
        'glass_unit_cost',
        'unit_price',
        'total',
        'total_cost_per_sqft',
        'total_material_cost',
        'total_fabrication_cost',
        'total_glass_cost',
        'client_reference_code'
        ];
   
    public function itemTemplates()
    {
        return $this->hasMany('Modules\Quotes\Entities\QuoteItemTemplate', 'quote_item_id_fk');
    }
    
    // public function itemTemplateSettings()
    // {
    //     return $this->hasManyThrough('Modules\Quotes\Entities\QuoteItemTemplateSetting', 'Modules\Quotes\Entities\QuoteItemTemplate', 'quote_item_id_fk', 'quote_item_template_id_fk');
    // }

    public function itemsnotes()
    {
        return $this->hasMany('Modules\Quotes\Entities\QuoteItemNotes');
    }

    public function itemsstatushistory()
    {
        return $this->hasMany('Modules\Quotes\Entities\QuoteItemStatusHistory');
    }
}