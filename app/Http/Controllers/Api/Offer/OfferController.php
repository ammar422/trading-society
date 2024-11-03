<?php

namespace App\Http\Controllers\Api\Offer;

use App\Models\User;
use App\Models\Offer;
use App\Traits\MediaTrait;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Requests\ApiStoreTradeRequest;
use App\Notifications\NewDealUploadedNotification;

class OfferController extends Controller
{
    use ApiResponseTrait, MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()  
    {  
        // Order by created_at descending to get newest offers first  
        $allOffers = Offer::orderBy('created_at', 'desc')->paginate(config('constants.PAGINATE_COUNT'));  
        
        return $this->successResponse(  
            OfferResource::collection($allOffers)->response()->getData(true),  
            'all_offers',  
            'All offers retrieved successfully'  
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



    public function store(ApiStoreTradeRequest $request)
    {
        $data =  $request->validated();
        if ($request->hasFile('chart')) {
            $chart = $this->saveImage('trades_images', $request->chart);
            $data['chart'] = $chart;
        }
        $data['instructor_id'] = auth('instructor-api')->id();
        $offer = Offer::create($data);
        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewDealUploadedNotification($offer, $user_id));
        }
        if ($offer)
            return $this->successResponse(
                new OfferResource($offer),
                'offer',
                'all offers get successfully and A notification has been sent to all users . '
            );

        return $this->failedResponse();
    }
}
