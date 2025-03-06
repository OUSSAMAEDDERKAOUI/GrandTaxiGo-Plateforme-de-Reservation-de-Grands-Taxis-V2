<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use App\Models\Trip;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function showPaymentForm($announcement_id, $price)
    {
        return view('payment', [
            'announcement_id' => $announcement_id,
            'price' => $price,
        ]);
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $request->input('price') * 100,
                'currency' => 'MAD',
                'source' => $request->input('stripeToken'),
                'description' => 'Trip Booking Payment',
            ]);
    
            $announcement = Announcement::find($request->input('announcement_id'));
    
            Payment::create([
                'announcement_id' => $announcement->id,
                'passenger_id' => auth()->id(),
                'driver_id' => $announcement->driver_id,
                'amount' => $request->input('price'),
                'currency' => 'MAD',
                'stripe_payment_intent_id' => $charge->id,
                'status' => 'passed',
            ]);

            return redirect()->route('passenger.trips')->with('success', 'Payment successful! Your trip is confirmed.');

        } catch (CardException $e) {

            $errorMessage = $this->getCardErrorMessage($e->getDeclineCode() ?? $e->getCode());
            return back()->withErrors($errorMessage);

        } catch (\Exception $e) {

            dd($e);
            return back()->withErrors('An unexpected error occurred. Please try again.');
        }
    }

    private function getCardErrorMessage($declineCode)
    {
        switch ($declineCode) {
            case 'stolen_card':
                return 'Your card was declined because it was reported as stolen. Please use a different card.';
            case 'insufficient_funds':
                return 'Your card was declined due to insufficient funds. Please use a different card or add funds to your account.';
            case 'expired_card':
                return 'Your card was declined because it has expired. Please use a different card.';
            case 'card_declined':
                return 'Your card was declined. Please check your card details or use a different card.';
            default:
                return 'Your card was declined. Please try again or use a different card.';
        }
    }
}