<?php

namespace Modules\Quotes\Entities;

use Illuminate\Database\Eloquent\Model;

class QuoteGlobalSettings extends Model {

    protected $table = "quote_global_settings";
    protected $fillable = [
        'field_code',
        'field_name',
        'field_value',
        'field_data_type',
        'remark',
        'setting_type'
        // 'created_at',
        // 'updated_at',
        // 'deleted_at',
        // 'created_by',
        // 'updated_by',
        // 'deleted_by'
    ];

}
