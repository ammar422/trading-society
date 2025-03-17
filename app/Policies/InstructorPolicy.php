<?php

namespace App\Policies;

use App\Models\Instructor;
use App\Models\SuperAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstructorPolicy
{
    use HandlesAuthorization;

    public function viewAny(SuperAdmin $superAdmin ): bool
    {
        return true;
    }

    public function view(SuperAdmin $superAdmin ,Instructor $instructor): bool
    {
        return true;
    }

    public function create(SuperAdmin $superAdmin ): bool
    {
        return true;
    }

    public function update(SuperAdmin $superAdmin ,Instructor $instructor): bool
    {
        return true;
    }

    public function delete(SuperAdmin $superAdmin ,Instructor $instructor): bool
    {
        return true;
    }
}
