<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BulkSmsController extends Controller
{
    //

    public function index(){

        // $events = Event::orderBy('created_at', 'desc')->paginate(30);
        return view('bulksms.index');
        
    }
}
