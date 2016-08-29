<?php namespace Modules\Quotes\Repositories;

interface QuoteActivityInterface{
	public function getActivityByCategory($data);
	public function createActivityLog($data);
}