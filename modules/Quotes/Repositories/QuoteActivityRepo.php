<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\QuoteActivityInterface;
use Modules\Quotes\Entities\QuoteActivityLogModel;
use Modules\Quotes\Repositories\Common;
class QuoteActivityRepo implements QuoteActivityInterface {

    public function getActivityByCategory($data) {
        $activity = QuoteActivityLogModel::where('category',$data['category'])->where('category_id',$data['category_id'])->get();
        return $activity;
    }

    public function createActivityLog($data) {
        //dd($data->log_type);
        $activity = new QuoteActivityLogModel;
        $activity->category=$data->category;;
        $activity->category_id=$data->category_id;
        $activity->log_type=$data->log_type;
        $activity->description=$data->description;
        $activity->created_by=$data->user_name;
        $activity->notes=$data->notes;
        $activity->save();
        return Common\Common::getJsonResponse(true, 'Activity logged successfully', 200);
    }

}
