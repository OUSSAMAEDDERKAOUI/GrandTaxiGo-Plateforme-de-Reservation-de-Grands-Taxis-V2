<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
public function index(){
    $availability = User::where('id', auth()->id())->first()->is_available;
    // dd($availability);
    $profile=user::where('id',auth()->id())->get();
   
    return view('/driver/availability',compact('availability','profile'));
}


public function changeAvailibilty(){
    
$user=User::where('id',auth()->id())->first();
if($user){
    if($user->is_available==true){
        $user->update(['is_available'=>false]);
    }
    elseif($user->is_available==false){
        $user->update(['is_available'=>true]);
    }
}
    return redirect()->route('show.availability');
   
}

    public function filteredByLocationAndAvailibility(Request $request){
        $location=$request->location;
    
        $drivers = User::where('is_available', true)
        ->where('location', $location)
        ->get();
        $profile=user::where('id',auth()->id())->get();

    return view('passenger/reservation',compact('drivers','profile'));
    
    }
    public function showProfile()
    {
        $profile = User::where('id', auth()->id())->get();
        $reviews=Review::with('driver')->where('id', auth()->id())->get();
        // $reviews = Review::with('user')->where('driver_id', Auth::id())->get();

dd($reviews);

        return view('driver/profile', compact('profile','reviews'));
    }


    
}
