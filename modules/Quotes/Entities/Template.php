<?php

namespace Modules\Quotes\Entities;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'quote_templates';
    protected $fillable = ["code", "product_model_id", "description", "type","remarks","image_id","is_active"];
    public function settings()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateSettings','quote_template_id_fk');
    }
    public function profiles()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateProfiles','quote_template_id_fk')->where('is_additional','=','0');
    }
    public function accessories()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateAccessories','quote_template_id_fk')->where('is_additional','=','0');
    }
    public function infill()
    {
        return $this->hasMany('Modules\Quotes\Entities\InfillModel','quote_template_id_fk');

    }
    public function itemInfill()
    {
          return $this->hasMany('Modules\Quotes\Entities\ItemTemplateInfilling','quote_template_id_fk');
    }

    public function image()
    {
          return $this->belongsTo('Modules\Quotes\Entities\Image','image_id')->select('id','image','description')->get();
    }

    public function additional_accessories()
    {
     return $this->hasMany('Modules\Quotes\Entities\TemplateAccessories','quote_template_id_fk')->where('is_additional','=','1');   
    }


    public function additional_profile()
    {
      return $this->hasMany('Modules\Quotes\Entities\TemplateProfiles','quote_template_id_fk')->where('is_additional','=','1');
    }
}
