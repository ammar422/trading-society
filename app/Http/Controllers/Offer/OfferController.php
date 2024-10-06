<?php

namespace App\Http\Controllers\Offer;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTradeRequest;
use App\Http\Resources\OfferResource;
use App\Models\Instructor;
use App\Traits\ApiResponseTrait;
use App\Traits\MediaTrait;

class OfferController extends Controller
{
    use ApiResponseTrait, MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allOffers = Offer::paginate(config('constants.PAGINATE_COUNT'));
        return $this->successResponse(
            OfferResource::collection($allOffers)->response()->getData(true),
            'all_offers',
            'all offers get successfully'
        );
    }

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
        if ($offer)
            return redirect()->route('offer.addNew')->with('success', 'Trade Alert (Offer) uploaded succesfully ');
        return redirect()->route('offer.addNew')->with('error', 'sorry , Trade Alert (Offer) cant be uploaded');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return $this->successResponse(
            new OfferResource($offer),
            'offer',
            'all offers get successfully'
        );
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
