<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    
    public function selectSearch(Request $request)
    {
    	$countries = [];
        if($request->has('q')){
            $search = $request->input('q');
            $countries = Country::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
                    ->orderBy('name', 'asc')
            		->get();
        }
        return response()->json($countries);
    }

}
