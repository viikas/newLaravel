<?php

namespace Modules\Quotes\Repositories;

use \Modules\Quotes\Repositories\QuoteStatusInterface;
use Modules\Quotes\Entities\QuoteStatus;
use Modules\Quotes\Repositories\Common\Common;

class QuoteStatusRepo implements QuoteStatusInterface {

    public function getAllStatuses() {
        return QuoteStatus::all();
    }

    public function createQuoteStatus($status) {
        // dd($status);
        $data = new QuoteStatus([
            'status_code' => $status->status_code,
            'status_name' => $status->status_name,
            'remarks' => $status->remarks,
        ]);

        $data->save();

        return Common::getJsonResponse(true, 'New QuoteStatus created Successfully !', 200);
    }

    public function updateQuoteStatus($status) {
        $data = QuoteStatus::findOrFail($status->id);

        $data->status_code = $status->status_code;
        $data->status_name = $status->status_name;
        $data->remarks = $status->remarks;

        $data->save();

        return Common::getJsonResponse(true, 'QuoteStatus updated successfully !', 200);
    }
    
    public function getStatusByID($id) {
        $status = QuoteStatus::findOrFail($id);
        return $status;
    }

}
