<?php

namespace Seat\Cara\Explorer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Http\Controllers\Controller;
use Seat\Cara\Explorer\Models\Setting;
use Seat\Cara\Explorer\Helpers\Sso;


class AuthController extends Controller
{
	public function index()
	{
		try {
			$authUrl = Sso::getAuthUrl();
		} catch(\Exception $e) {
			return redirect('explorer/settings')->with('error', $e->getMessage());
		}

		return view("explorer::auth.index", [
        	'url' => $authUrl
        	]);
	}

    public function callback(Request $request)
    {
    	if(session()->has('sso-state') && $request->state == session('sso-state')) {

			try {
				Sso::login($request->code);
    			return redirect('explorer/maps')->with('success', trans('explorer::success.auth'));		
			} catch(\Exception $e) {
				return redirect('explorer/settings')->with('error', $e->getMessage());
			}
    	} else {
    		return redirect('explorer/maps')->with('error', trans('explorer::errors.state_sso'));
    	}
    }
}