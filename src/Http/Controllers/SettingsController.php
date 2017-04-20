<?php

namespace Seat\Cara\Explorer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Http\Controllers\Controller;
use Seat\Cara\Explorer\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
    	return view("explorer::settings.index", 
        	['settings' => Setting::all()->first()]
    	);
    }
}