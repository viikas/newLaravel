<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Quotes\Repositories\QuotesInterface;
use Modules\Quotes\Http\Requests\CreateQuoteRequest;
use Modules\Quotes\Http\Requests\UpdateQuoteRequest;
use Modules\Quotes\Http\Requests\CreateQuoteOptionRequest;
use Modules\Quotes\Http\Requests\CreateQuoteRevisionRequest;
use Modules\Quotes\Http\Requests\CreateQuoteItemRequest;
use \Modules\Quotes\Http\Requests\ChangeStatusRequest;
use Modules\Quotes\Http\Requests\CreateNoteRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
class QuotesController extends Controller {

    protected $quotesRepo;

    public function __construct(QuotesInterface $quotesInterface) {
        $this->quotesRepo = $quotesInterface;
    }

    public function get($opportunityId) {
        $finalResponse = $this->quotesRepo->getQuotesByOpportunityId($opportunityId);

        return response()->json($finalResponse);
    }


  public function getquotes() {
        $data = $this->quotesRepo->getquotes();

        return response()->json($data);
    }

    /*
     * Get items related to quote
     * @param int $quoteId
     */

    public function getItems($quoteId) {
        $quote = $this->quotesRepo->getSingleQuote($quoteId);

        return response()->json($quote);
    }

    /*
     * Get templates, templateSettings, templateAccessories, templateProfiles related to item
     * param int $itemId
     */

    public function getItemInfos($itemId) {
        $item = $this->quotesRepo->getSingleItem($itemId);

        return response()->json($item);
    }

    public function add(CreateQuoteRequest $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->createQuote($data);
        return $response;
    }

    public function addNewImage(Request $request){
        $data = json_decode(json_encode($request->all()));
        dd($data);
    }


    public function update(UpdateQuoteRequest $request) {

        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->updateQuote($data);
        return $response;
    }

    /*
     * Add new revision of given quote
     */

    public function addRevision(CreateQuoteRevisionRequest $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->createQuoteRevision($data);
        return $response;
    }

    /*
     * Add new quote option
     */

    public function addOption(CreateQuoteOptionRequest $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->createQuoteOption($data);
        return $response;
    }

    public function addItem(CreateQuoteItemRequest $request) {
        $data = json_decode(json_encode($request->all()), true);

        $response = $this->quotesRepo->createQuoteItem($data);
        return $response;
    }

    public function updateItem(CreateQuoteItemRequest $request) {
        $data = json_decode(json_encode($request->all()), true);

        $response = $this->quotesRepo->updateQuoteItem($data);
        return $response;
    }

    public function quoteDisplay($id) {
        $display = $this->quotesRepo->quoteDisplay($id);

        return response()->json($display);
    }
    
    public function changeStatus(ChangeStatusRequest $request) {
        $data=$request->all();
        $response = $this->quotesRepo->changeStatus($data);
        //return response()->json($response);
        return $response;
    }
    
    public function addNote(CreateNoteRequest $request) {
        $data=$request->all();
        $response = $this->quotesRepo->addNote($data);
        //return response()->json($response);
        return $response;
    }

   public function getCMSByQuoteId($id) {
        $data = $this->quotesRepo->getcmsByQuoteId($id);
        return response()->json($data);
    }

    public function addImage(Request $request){
        // dd($request)
        $data = json_decode(json_encode($request->all()));
        $data = $this->quotesRepo->uploadQuoteItemImage($data);
        dd($data);
        return $data;


   }


   public function updateImage(Request $request){
        // dd($request->all());
        $data = json_decode(json_encode($request->all()));
        $update = $this->quotesRepo->updateQuoteItemImage($data);
        return $update;
    }

 public function deleteImage($id) {
        $delete = $this->quotesRepo->deleteQuoteItemImage($id);
        return $delete;
    }
public function updatePaymentOption(Request $request){
        $data = json_decode(json_encode($request->all()));
        // dd($data);
        $update = $this->quotesRepo->updatePaymentOptions($data);
        return $update;
    }
public function addItemImage(Request $request){
    // return $request->all();
    $data = json_decode(json_encode($request->all()));
    $data=$this->quotesRepo->addNewItemImage($data);
    return $data;
}
public function getItemImages($id){
    $finalResponse=$this->quotesRepo->getItemImages($id);
    return response()->json($finalResponse);
}

 public function revisionfirst(Request $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->revisionfirst($data);
        return $response;
    }


 public function revisionsecond(Request $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->revisionsecond($data);
        return $response;
    }

public function revisionthird(Request $request) {
        $data = json_decode(json_encode($request->all()), true);
        $response = $this->quotesRepo->revisionthird($data);
        return $response;
    }


public function getquotelist() {
        $data = $this->quotesRepo->getquotelist();

        return response()->json($data);
    }


}
