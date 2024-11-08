<?php

namespace App\Http\Controllers\Mvc\Offer;

use App\Models\User;
use App\Models\Offer;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTradeRequest;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Notifications\NewDealUploadedNotification;


class OfferController extends Controller
{
    use MediaTrait;


    public function offerMainPage()
    {
        $instructor = auth('instructor')->user();
        $offers = $instructor->offers()->paginate(config('constants.PAGINATE_COUNT'));
        return view('offers', compact('offers'));
    }



    public function offerDetails($id)
    {
        $offer = Offer::find($id);
        return view('offers_details', compact('offer'));
    }



    public function newTradeAlert()
    {
        $instructors = Instructor::all();
        return view('offers_add_new', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTradeRequest $request)
    {
        $data =  $request->validated();
        $chart = $this->saveImage('trades_images', $request->chart);
        $data['chart'] = $chart;
        $offer = Offer::create($data);

        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewDealUploadedNotification($offer, $user_id));
        }

        $title = 'Notification for offer';
        $body = "offer pair: " . $offer->pair;
        $offer_id = $offer->id;


        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

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


        if ($offer)
            return redirect()->route('offer.addNew')->with('success', 'Trade Alert (Offer) uploaded succesfully ');
        return redirect()->route('offer.addNew')->with('error', 'sorry , Trade Alert (Offer) cant be uploaded');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update( $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
    }
}
