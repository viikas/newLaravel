<?php namespace Modules\Quotes\Repositories;

interface QuoteStatusInterface{
    public function getAllStatuses();
    //public function getSingleStatus($statusID);
    public function createQuoteStatus($status);
    public function updateQuoteStatus($status);
    public function getStatusByID($id);
}

