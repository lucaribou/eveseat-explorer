<?php

namespace Seat\Cara\Explorer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Http\Controllers\Controller;
use Seat\Cara\Explorer\Helpers\Sso;

class MapsController extends Controller
{
    public function index()
    {
    	try {
    		$location = Sso::getLocation();
    	} catch(\Exception $e) {
    		return redirect('explorer/auth')->with('error', $e->getMessage());
    	}
    	return view("explorer::maps.index", ['location' => $location]);
    }
}