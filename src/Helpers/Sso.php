<?php

namespace Seat\Cara\Explorer\Helpers;

use Seat\Cara\Explorer\Models\Setting;

class Sso
{
	
	public static function getAuthUrl()
	{
		$setting = Setting::all()->first();

    	$state = uniqid();

		// Store the tmp state token in session
    	session(['sso-state' => $state]);

    	$baseUri = "https://login.eveonline.com/oauth/authorize?";

    	$clientId = decrypt($setting->client_id);

    	$httpData = array(
    		'response_type' => 'code',
    		'redirect_uri'	=> url('/explorer/auth/callback'),
    		'client_id'		=> $clientId,
    		'scope'			=> 'esi-location.read_location.v1',
    		'state'			=> $state
    		);

    	return $baseUri . http_build_query($httpData);
	}
}