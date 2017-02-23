<?php

namespace Seat\Cara\Explorer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Http\Controllers\Controller;

class ExplorerController extends Controller
{
    public function index()
    {
        return view("explorer::index");
    }
}