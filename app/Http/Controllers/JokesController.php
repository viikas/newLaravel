<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Joke;
use App\User;
class JokesController extends Controller
{
    public function index(Request $request)
    {      
        $search_term = $request->input('search');
        $limit = $request->input('limit',5);

        if ($search_term)
        {
            $jokes = Joke::orderBy('id', 'DESC')->where('joke', 'LIKE', "%$search_term%")->with(
            array('User'=>function($query){
                $query->select('id','name');
            })
            )->select('id', 'joke', 'user_id')->paginate($limit); 

            $jokes->appends(array(
                'search' => $search_term,
                'limit' => $limit
            ));
        }
        else
        {
            $jokes = Joke::orderBy('id', 'DESC')->with(
            array('User'=>function($query){
                $query->select('id','name');
            })
            )->select('id', 'joke', 'user_id')->paginate($limit); 

            $jokes->appends(array(            
                'limit' => $limit
            ));
        }
        
        return JsonResponse::create($this->transformCollection($jokes), 200);
    }
    
    public function show($id){
        $joke = Joke::with(
            array('User'=>function($query){
                $query->select('id','name');
            })
            )->find($id);
 
        if(!$joke){
            return JsonResponse::create([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
         // get previous joke id
        $previous = Joke::where('id', '<', $joke->id)->max('id');
 
        // get next joke id
        $next = Joke::where('id', '>', $joke->id)->min('id');        
 
        return JsonResponse::create([
            'previous_joke_id'=> $previous,
            'next_joke_id'=> $next,
            'data' => $this->transform($joke)
        ], 200);
    }
    
    /*private function transformCollection($jokes){
		return array_map([$this, 'transform'], $jokes->toArray());
	}

	private function transform($joke){
		return [
			   'joke_id' => $joke['id'],
			   'joke' => $joke['joke']
			];
	}*/
	
	private function transformCollection($jokes){
        $jokesArray = $jokes->toArray();
        return [
            'total' => $jokesArray['total'],
            'per_page' => intval($jokesArray['per_page']),
            'current_page' => $jokesArray['current_page'],
            'last_page' => $jokesArray['last_page'],
            'next_page_url' => $jokesArray['next_page_url'],
            'prev_page_url' => $jokesArray['prev_page_url'],
            'from' => $jokesArray['from'],
            'to' =>$jokesArray['to'],
            'data' => array_map([$this, 'transform'], $jokesArray['data'])
        ];
    }
    
    private function transform($joke){
		return [
			   'joke_id' => $joke['id'],
			   'joke' => $joke['joke']
			];
	}
	
	public function store(Request $request)
    {

        if(! $request->joke or ! $request->user_id){
            return JsonResponse::create([
                'error' => [
                    'message' => 'Please Provide Both joke and user_id'
                ]
            ], 422);
        }
        $joke = Joke::create($request->all());

        return JsonResponse::create([
                'message' => 'Joke Created Succesfully',
                'data' => $this->transform($joke)
        ]);
    }
    
    public function update(Request $request, $id)
    {    
        if(! $request->joke or ! $request->user_id){
            return JsonResponse::create([
                'error' => [
                    'message' => 'Please Provide Both body and user_id'
                ]
            ], 422);
        }
        
        $joke = Joke::find($id);
        $joke->joke = $request->joke;
        $joke->user_id = $request->user_id;
        $joke->save(); 

        return JsonResponse::create([
                'message' => 'Joke Updated Succesfully'
        ]);
    }
    
    public function destroy($id)
    {
        Joke::destroy($id);
    }
    
}
