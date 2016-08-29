<?php namespace Modules\Quotes\Repositories\Models;

class QuoteGlobalSettingsModel
{
    public $id;
    public $field_code;
    public $field_name;
    public $field_value;
    public $field_data_type;
    public $remark;
    public $setting_type;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    public $created_by;
    public $updated_by;
    public $deleted_by;
  public function set($data) {
        foreach ($data AS $key => $value) $this->{$key} = $value;
    }
}

