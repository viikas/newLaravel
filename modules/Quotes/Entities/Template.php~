<?php

namespace Modules\Quotes\Entities;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    protected $table = 'quote_templates';
    protected $fillable = ["code", "description", "type"];
    public function settings()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateSettings','quote_template_id_fk');
    }
    public function profiles()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateProfiles','quote_template_id_fk');
    }
    public function accessories()
    {
        return $this->hasMany('Modules\Quotes\Entities\TemplateAccessories','quote_template_id_fk');
    }
}
