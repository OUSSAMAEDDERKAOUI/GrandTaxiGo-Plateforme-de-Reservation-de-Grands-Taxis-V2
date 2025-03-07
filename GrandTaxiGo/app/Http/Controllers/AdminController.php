<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class AdminController extends Controller
{
    public function showStatistiques()
    {
        $allUsers = User::where('is_available', 'true')->count();
        $completedReservation = Reservation::where('status', 'completed');
        $allAnouncements = Announcement::where('status', 'open')->count();

        $revenu = Announcement::avg('price');
        $revenu_parse = number_format($revenu, 2);
        return    view('admin/dashboard', compact('allUsers', 'completedReservation', 'allAnouncements', 'revenu_parse'));
    }

    public function viewAllUsers()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->simplePaginate(6);

        return view('admin.users', compact('users'));
    }

   
}
