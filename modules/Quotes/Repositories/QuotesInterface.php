<?php

namespace Modules\Quotes\Repositories;

interface QuotesInterface {

    public function getQuotesByOpportunityId($opportunityId);

    public function getDistinctOptionByOpportunityId($opportunityId);

    public function getDistinctQuoteNbrByOpportunityId($opportunityId);

    public function getRevisionsByQuoteNbrAndOption($quoteNbr, $option);

    public function getListByQuoteNbr($quoteNbr);

    public function getByOpportunityId($opportunityId);

    public function getSingleOpportunityInfo($opportunityId);

    public function getActiveQuotes();

    public function getSingleQuote($quoteID);

    public function getSingleItem($itemId);

    public function getSingleActiveQuote($quoteID);

    public function getActiveQuotesByIDs($ids);

    public function createQuote($data);

    public function updateQuote($data);

    public function createQuoteRevision($data);

    public function createQuoteOption($data);

    public function createQuoteItem($data);

    public function updateQuoteItem($data);

    public function changeStatus($data);
    
    public function addNote($data);


    
     public function getquotes();
      public function getcmsByQuoteId($id);
    public function uploadQuoteItemImage();
    public function updateQuoteItemImage($image);
    public function deleteQuoteItemImage($id);
    public function updatePaymentOptions($quote);

    // Item Image
    public function addNewItemImage($image);
    // get Item Images
    public function getItemImages($id);



    public function revisionfirst($data);
    public function revisionsecond($data);


    public function getquotelist();
    public function revisionthird($data,$destination);
}
