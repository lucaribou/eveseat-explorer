<?php

namespace Seat\Cara\Explorer\Helpers;

use Seat\Cara\Explorer\Models\Setting;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Sso
{
    private static $EsiBaseUri = "https://esi.tech.ccp.is/latest/";
	
	public static function getAuthUrl()
	{
		$setting = Setting::all()->first();

        if(!$setting) throw new \Exception(trans("explorer::errors.insert_settings"));

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

    public static function login($code) 
    {
        $setting = Setting::all()->first();

        if(!$setting) throw new \Exception(trans("explorer::errors.insert_settings"));

        $client = new \GuzzleHttp\Client();
        $resp = $client->request('POST', 'https://login.eveonline.com/oauth/token', [
            'form_params'   => [
                'code'          => $code,
                'grant_type'    => 'authorization_code'
                ],
            'headers'   => [
                'Authorization'     => 'Basic ' . base64_encode(decrypt($setting->client_id) . ':' . decrypt($setting->secret_key))
                ]
            ]
        );

        $accessToken = json_decode($resp->getBody())->access_token;

        session(['sso-token' => $accessToken]);

        $characterResponse = $client->request('GET', "https://login.eveonline.com/oauth/verify", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
                ]
            ]
        );

        $character = json_decode($characterResponse->getBody());
        session(['sso-character' => $character]);
    }

    public static function getLocation()
    {
        $client = new \GuzzleHttp\Client();
        try {
            $resp = $client->request('GET', self::$EsiBaseUri . "characters/" . session('sso-character')->CharacterID . "/location", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('sso-token')
                    ]
                ]
            );
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            // throw new \Exception(json_decode($e->getResponse()->getBody()->getContents())->error);
            $statusCode = $e->getResponse()->getStatusCode();
            switch ($statusCode) {
                case 403:
                    throw new \Exception(trans("explorer::errors.invalid_token"));
                    break;
                default:
                    throw new \Exception(trans("explorer::errors.default_sso_error"));
            }
        }
        return json_decode($resp->getBody());
    }
}