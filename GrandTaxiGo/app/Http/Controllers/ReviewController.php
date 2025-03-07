<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {
        return view('review'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatData=$request->validate([
            'rating'=>['required','integer','max:5'],
            'comment'=>['required','string'],
        ]);
        // dd($request->driver_id);
        $review=Review::Create([
            'review'=>$validatData['rating'],
            'comment'=>$validatData['comment'],
            'driver_id'=>$request->driver_id,
            'passenger_id'=>auth()->id(),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
