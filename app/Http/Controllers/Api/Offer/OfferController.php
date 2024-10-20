<?php

namespace App\Http\Controllers\Api\Offer;

use App\Models\Offer;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
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

   

    public function show(Offer $offer)
    {
        return $this->successResponse(
            new OfferResource($offer),
            'offer',
            'all offers get successfully'
        );
    }
}
