<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Http\Requests\Request;
use Modules\Quotes\Repositories\QuoteStatusInterface;
use Modules\Quotes\Http\Requests\CreateQuoteStatusRequest;

class QuoteStatusController extends Controller {

    protected $quoteStatusRepo;

    public function __construct(QuoteStatusInterface $quoteStatusInterface) {
        $this->quoteStatusRepo = $quoteStatusInterface;
    }

    public function get() {
        $allStatuses = $this->quoteStatusRepo->getAllStatuses();
        return response()->json($allStatuses);
    }

    public function getById($id) {
        $status = $this->quoteStatusRepo->getSingleStatus($id);
        return response()->json($status);
    }

    public function add(CreateQuoteStatusRequest $request) {
        $data=json_decode(json_encode($request->all()));
        // dd($data);
        $response=$this->quoteStatusRepo->createQuoteStatus($data);
        return $response;
    }

    public function update(CreateQuoteStatusRequest $request){
        $data=json_decode(json_encode($request->all()));
       //dd($data);
        $response=$this->quoteStatusRepo->updateQuoteStatus($data);
        return $response;
    }

}
