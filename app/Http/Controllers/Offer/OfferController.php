<?php

namespace App\Http\Controllers\Offer;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Traits\ApiResponseTrait;

class OfferController extends Controller
{
    use ApiResponseTrait;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
