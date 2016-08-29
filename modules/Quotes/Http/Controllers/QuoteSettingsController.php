<?php namespace Modules\Quotes\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class QuoteSettingsController extends Controller {
	
	public function index()
	{
		return view('quotes::index');
	}
	
}