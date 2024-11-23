<?php

namespace App\Http\Controllers\Mvc\Admins\Offres;

use App\Models\User;
use App\Models\Offer;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;

use function PHPUnit\Framework\returnSelf;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Http\Requests\UpdateAdminOfferRequest;
use App\Http\Requests\UpdateAdminOrderRequest;
use App\Notifications\NewDealUploadedNotification;

class AdminOffersController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::all();
        return view('admin.offers', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::all();
        return view('admin.new_offer', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        // return $request->validated();
        $data =  $request->validated();
        if ($request->has('chart')) {
            $chart = $this->saveImage('trades_images', $request->chart);
            $data['chart'] = $chart;
        }
        $offer = Offer::create($data);

        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewDealUploadedNotification($offer, $user_id));
        }

        $title = 'Notification for offer';
        $body = "offer pair: " . $offer->pair;
        $offer_id = $offer->id;

        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->filter()->toArray();

        if (!empty($tokens)) {

            // Create a CloudMessage instance
            $message = CloudMessage::new()
                ->withNotification([
                    'title' => $title,
                    'body' => $body,
                    'offer_id' => $offer_id
                ]);

            // Send the message as a multicast to all FCM tokens
            $report = Firebase::messaging()->sendMulticast($message, $tokens);

            // Check for any failed tokens
            if (count($report->failures()) > 0) {
                foreach ($report->failures() as $failure) {
                    \Log::error("Failed to send to {$failure->target()}: {$failure->error()->getMessage()}");
                }
            }
        }

        if ($offer)
            return redirect()->route('admin.offers')->with('success', 'Trade Alert (Offer) uploaded succesfully ');
        return redirect()->route('admin.offers')->with('error', 'sorry , Trade Alert (Offer) cant be uploaded');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offer = Offer::find($id);
        return view('admin.edit_offer', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminOfferRequest $request, $id)
    {
        $offer = Offer::find($id);
        $data = $request->validated();
        if ($request->has('chart')) {
            $chart = $this->saveImage('trades_images', $request->chart);
            $data['chart'] = $chart;
        }
        $offer->update($data);

        // $users = User::all();
        // foreach ($users as $user) {
        //     $user_id = $user->id;
        //     $user->notify(new NewDealUploadedNotification($offer, $user_id));
        // }

        $title = 'Notification for offer';
        $body = "offer pair: " . $offer->pair;
        $offer_id = $offer->id;

        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->filter()->toArray();

        if (!empty($tokens)) {

            // Create a CloudMessage instance
            $message = CloudMessage::new()
                ->withNotification([
                    'title' => $title,
                    'body' => $body,
                    'offer_id' => $offer_id
                ]);

            // Send the message as a multicast to all FCM tokens
            $report = Firebase::messaging()->sendMulticast($message, $tokens);

            // Check for any failed tokens
            if (count($report->failures()) > 0) {
                foreach ($report->failures() as $failure) {
                    \Log::error("Failed to send to {$failure->target()}: {$failure->error()->getMessage()}");
                }
            }
        }

        if ($offer)
            return redirect()->route('admin.offers')->with('success', 'Trade Alert (Offer) uploaded succesfully ');
        return redirect()->route('admin.offers')->with('error', 'sorry , Trade Alert (Offer) cant be updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $success =  $offer->delete();
        if ($success)
            return redirect()->route('admin.offers')->with('success', 'Trade Alert (Offer) deleted succesfully ');
        return redirect()->route('admin.offers')->with('error', 'sorry , Trade Alert (Offer) cant be deleted');
    }
}
