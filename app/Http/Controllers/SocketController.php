<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocketController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		return view('socket')
			->with('counter', $request->session()->get('counter', 0))
		;
	}
	
	public function increment(Request $request)
    {
		$counter = $request->session()->get('counter', 0);
		$counter++;
		$request->session()->put('counter', $counter);
		return response()->json([
			'success' => true
		]);
    }
}
