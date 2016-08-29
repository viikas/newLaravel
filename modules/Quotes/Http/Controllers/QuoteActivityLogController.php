<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Quotes\Repositories\QuoteActivityInterface;
use Illuminate\Http\Request;
use Modules\Quotes\Http\Requests\CreateActivityLogRequest;

class QuoteActivityLogController extends Controller {

    protected $activityRepo;

    public function __construct(QuoteActivityInterface $activityInterface) {
        $this->activityRepo = $activityInterface;
    }

    public function getActivityByCategory(Request $request) {
        $data = $request->all();
        $response = $this->activityRepo->getActivityByCategory($data);
        return $response;
    }

    public function createActivityLog(CreateActivityLogRequest $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->activityRepo->createActivityLog($data);
        return $response;
    }

}
