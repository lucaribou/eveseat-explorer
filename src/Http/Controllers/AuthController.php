<?php

namespace Seat\Cara\Explorer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Http\Controllers\Controller;
use Seat\Cara\Explorer\Models\Setting;
use Seat\Cara\Explorer\Helpers\Sso;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class AuthController extends Controller
{
	public function index()
	{
		$authUrl = Sso::getAuthUrl();

		return view("explorer::auth.index", [
        	'url' => $authUrl
        	]);
	}

    public function callback(Request $request)
    {
    	if(session()->has('sso-state') && $request->state == session('sso-state')) {

			$setting = Setting::all()->first();

			if(!$setting) return redirect('explorer/settings')->with('error', trans('explorer::errors.insert_settings'));

			$client = new \GuzzleHttp\Client();
			$resp = $client->request('POST', 'https://login.eveonline.com/oauth/token', [
				'form_params' 	=> [
					'code'			=> $request->code,
					'grant_type'	=> 'authorization_code'
					],
				'headers'	=> [
				    'Authorization'     => 'Basic ' . base64_encode(decrypt($setting->client_id) . ':' . decrypt($setting->secret_key))
				    ]
				]
			);
			session(['sso-token' => json_decode($resp->getBody())->access_token]);
    		return redirect('explorer/maps')->with('success', trans('explorer::success.auth'));
    	} else {
    		return redirect('explorer/maps')->with('error', trans('explorer::errors.state_sso'));
    	}
    }
}