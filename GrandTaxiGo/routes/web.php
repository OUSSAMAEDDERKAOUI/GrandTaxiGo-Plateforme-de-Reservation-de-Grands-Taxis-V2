<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DriverController;
use App\Models\Announcement;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;


Route::middleware(['role:passenger'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/passenger/trips', [ReservationController::class, 'showPassengerReservations'])->name('passenger.trips');
    Route::post('/cancel/{id}/reservation', [ReservationController::class, 'cancel'])->name('cancel.reservation');
    Route::post('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('passenger/reservation', [DriverController::class, 'filteredByLocationAndAvailibility'])->name('passenger.filteredDrivers');
    Route::post("/filtered/reservations",[DriverController::class,'filteredByLocationAndAvailibility'])->name('filtered.drivers');

    // Route::get('/review/driver',[ReviewController::class,'index'])->name('showReview');
    



});
Route::middleware(['role:driver'])->group(function () {
    Route::get('/driver-dashboard', [DriverController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/driver/trips', [ReservationController::class, 'showDriverReservations'])->name('driver.trips');
    Route::post('driver/announcement', [AnnouncementController::class, 'storeAnnouncement'])->name('storeAnnouncement');
    Route::get('driver/announcement', [AnnouncementController::class, 'showAllAnnouncements'])->name('driver.announcements');
    Route::post('/reservations/{id}/accept', [ReservationController::class, 'accept'])->name('accept.reservation');
    Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reject.reservation');
    Route::post('/Reservation/{id}/complet', [ReservationController::class, 'complet'])->name('complet.reservation');
    Route::post('/driver/availability', [DriverController::class, 'changeAvailibilty'])->name('change.availability');
    Route::get('/driver/availability', [DriverController::class, 'index'])->name('availability.index');
    Route::get('/driver/availability',[DriverController::class,'index'])->name('show.availability');

    Route::get('driver/profile',[DriverController::class,'showProfile'])->name('showProfile');


});




Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard',[AdminController::class,'showStatistiques'])->name('dashboard');
    Route::get('/admin/users', [AdminController::class, 'viewAllUsers'])->name('admin.view.all.users');
    Route::post('/admin/user/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.delete.user');


    Route::get('/admin/trajets', [AdminController::class, 'viewTrajets'])->name('admin.view.trajets');
    Route::get('/admin/reviews', [AdminController::class, 'viewReviews'])->name('admin.view.reviews');

    Route::post('/admin/review/{id}/delete', [AdminController::class,'deleteReview'])->name('delete.review');

});

Route::middleware('guest')->group(function () {
    Route::get('/auth/register', [RegisteredUserController::class, 'showRegister'])->name("showRegister");
    Route::post('/auth/register', [RegisteredUserController::class, 'storeRegister'])->name("storeRegister");
    Route::get('/auth/login', [RegisteredUserController::class, 'login'])->name("login");
    Route::post('/auth/login', [RegisteredUserController::class, 'loginPoste'])->name("loginPoste");

    //socialite 
   
});
Route::middleware('auth')->group(function () {
    Route::get('driver/announcement', [AnnouncementController::class, 'showAllAnnouncements'])->name('driver.announcements');
    Route::get('passenger/announcement', [AnnouncementController::class, 'showAllAnnouncementsForPassenger'])->name('passenger.announcements');
    Route::get('/announcements/{announcementId}/reservations', [AnnouncementController::class, 'getReservations'])->name('announcement.reservations');
    Route::post('/auth/logout',[RegisteredUserController::class,'logout'])->name("logout");




});
Route::get('/home',[RegisteredUserController::class,'home'])->name("home");

Route::get('/auth/google',[SocialiteController::class,'redirectToGoogle'])->name('loginWithGoogle');
Route::get('auth/google/callback',[SocialiteController::class,'handleGoogleCallback']);

Route::get('payment',[PaypalController::class,'payment'])->name('payment');
  Route::get('cancel','PaypalController@cancel')->name('payment.cancel');
  Route::get('payment/success','PaypalController@success')->name('payment.success');



//stripe payment
  Route::post('/payment/{announcement_id}/{price}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');



Route::post('review/post',[ReviewController::class,'store'])->name('storeReview');

Route::get('/review', [ReviewController::class, 'show'])->name('showReview');

Route::get('/send-user-info-qr/{user}', [RegisteredUserController::class, 'storeRegister']);
