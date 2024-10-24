<?php

namespace App\Http\Controllers\Mvc\Offer;

use App\Models\User;
use App\Models\Offer;
use App\Models\Instructor;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTradeRequest;
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



    public function offerDetails(Offer $offer)
    {

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
        if ($offer)
            return redirect()->route('offer.addNew')->with('success', 'Trade Alert (Offer) uploaded succesfully ');
        return redirect()->route('offer.addNew')->with('error', 'sorry , Trade Alert (Offer) cant be uploaded');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
