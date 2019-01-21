<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocketCounter;

class SocketController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$counter = SocketCounter::getInstance();
		return view('socket')
			->with('counter', $counter->value())
		;
	}
	
	/**
     * backend method for incrementing counter value
     *
     * @return \Illuminate\Http\Response
     */
	public function increment(Request $request)
    {
		$counter = SocketCounter::getInstance();
		$newValue = $counter->increment();
		return response()->json([
			'success' => true,
			'newValue' => $newValue
		]);
    }
}
