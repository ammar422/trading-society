<?php

namespace App\Policies;

use App\Models\Instructor;
use App\Models\Offer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    public function viewAny(Instructor $Instructor): bool
    {
        return true;
    }

    public function view(Instructor $Instructor, Offer $Offer): bool
    {
        return $Offer->Instructor_id == $Instructor->id;
    }

    public function create(Instructor $Instructor): bool
    {
        return true;
    }

    public function update(Instructor $Instructor, Offer $Offer): bool
    {
        return $Offer->Instructor_id == $Instructor->id;
    }

    public function delete(Instructor $Instructor, Offer $Offer): bool
    {
        return $Offer->Instructor_id == $Instructor->id;
    }
}
