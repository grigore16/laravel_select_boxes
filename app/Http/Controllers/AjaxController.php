<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    
    public function index(Request $request)
    {
        if($request['countries']){
			
			$countries = ['Germany', 'France'];
			return response()->json(['countries'=>$countries]);	
		}
		
		if($request['country']){
			if($request['country'] === 'Germany'){
				$cities = ['Hamburg', 'Berlin'];
			}
			if($request['country'] === 'France'){
				$cities = ['Paris', 'Lion'];
			}
			
			return response()->json(['cities'=>$cities]);	
		}
		
		if($request['city']){
			
			if($request['city'] === 'Hamburg'){
				$streets = ['h1', 'h2', 'h3'];
			}
			if($request['city'] === 'Berlin'){
				$streets = ['b1', 'b2', 'b3'];
			}
			if($request['city'] === 'Paris'){
				$streets = ['p1', 'p2', 'p3'];
			}
			if($request['city'] === 'Lion'){
				$streets = ['l1', 'l2', 'l3'];
			}
			return response()->json(['streets'=>$streets]);
		}
    }

    
}
