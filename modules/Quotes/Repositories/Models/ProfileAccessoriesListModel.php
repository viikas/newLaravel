<?php namespace Modules\Quotes\Repositories\Models;
class ProfileAccessoriesListModel
{
  public $id;
    public $product_id;
    public $invent_price;
    public $revised_price;
    public $effective_date;
    public $deleted;
    public $user;
    public $remark;
    public $created_at;
    public $updated_at;
     public function set($data) {
        foreach ($data AS $key => $value) $this->{$key} = $value;
    }

	}