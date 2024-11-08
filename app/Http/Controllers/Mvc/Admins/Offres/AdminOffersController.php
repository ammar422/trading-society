<?php

namespace App\Http\Controllers\Mvc\Admins\Offres;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminOfferRequest;
use App\Http\Requests\UpdateAdminOrderRequest;

use function PHPUnit\Framework\returnSelf;

class AdminOffersController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
       return $offer = Offer::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
