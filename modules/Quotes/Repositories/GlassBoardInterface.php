<?php namespace Modules\Quotes\Repositories;

interface GlassBoardInterface{
	public function getGlassTypes();
	public function getLatestGlasstypeRevision();
	public function getBoards();
        public function getAllGlassAndBoards();
	public function getLatestBoardRevisionPrice();
	public function getGlassTypeRevisionByDate($date);
	public function updateGlassTypeRevision($glassPrice);
	public function updateBoardTypeRevision($boardPrice);
	public function addBulkGlassRevision($bulkGlass);
	public function addBulkBoardRevision($bulkBoard);
        public function getGlassBible();
//	public function addNewBoard($data);
	
}