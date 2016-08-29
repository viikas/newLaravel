<?php

namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Quotes\Repositories\GlassBoardInterface;
use Illuminate\Http\JsonResponse;
use Modules\Quotes\Http\Requests\BoardRequest;

class GlassPriceRevisionController extends Controller {

    protected $glassboardRepo;

    public function __construct(GlassBoardInterface $GlassBoardInterface) {
        $this->glassboardRepo = $GlassBoardInterface;
    }

    public function getGlass() {

        $glassprice = $this->glassboardRepo->getGlassTypes();
        return response()->json($glassprice);
    }

    public function getLatestGlasstypeRevision() {
        $glassprice = $this->glassboardRepo->getLatestGlasstypeRevision();
        return response()->json($glassprice);
    }

    public function getBoards() {

        $board = $this->glassboardRepo->getBoards();
        return response()->json($board);
    }

    public function getAllGlassAndBoards() {
        $glassBoards = $this->glassboardRepo->getAllGlassAndBoards();
        //dd($glassBoards);
        return response()->json($glassBoards);
    }

    public function getLatestBoardRevisionPrice() {
        $boardprice = $this->glassboardRepo->getLatestBoardRevisionPrice();
        return response()->json($boardprice);
    }

    public function getGlassTypeRevisionByDate($date) {
        $data = $this->glassboardRepo->getGlassTypeRevisionByDate($date);
        return response()->json($data);
    }

    public function getBoardTypeRevisionByDate($date) {
        $data = $this->glassboardRepo->getBoardTypeRevisionByDate($date);
        return response()->json($data);
    }

    public function updatePriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->glassboardRepo->updateGlassTypeRevision($data);
        return $update;
    }

    public function updateBoardPriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $update = $this->glassboardRepo->updateBoardTypeRevision($data);
        return $update;
    }

    public function addGlassPriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $add = $this->glassboardRepo->addBulkGlassRevision($data);
        return $add;
    }

    public function addBoardPriceRevision(Request $request) {
        $data = json_decode(json_encode($request->all()));
        $add = $this->glassboardRepo->addBulkBoardRevision($data);
        return $add;
    }

    /*
     * Get glass bible 
     */
    public function getGlassBible() {
        $data = $this->glassboardRepo->getGlassBible();

        return response()->json($data);
    }
    
    /*
     * Get latest glass and board price for each thickness
     */
    public function getGlassAndBoardPrice() {
        $data = $this->glassboardRepo->getGlassAndBoardPrice();

        return response()->json($data);
    }
}
