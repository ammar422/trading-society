<?php

namespace App\Policies;

use App\Models\SuperAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SuperAdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(SuperAdmin $superAdmin): bool
    {
        return true;
    }

    public function view(SuperAdmin $superAdmin): bool
    {
        return true;
    }

    public function create(SuperAdmin $superAdmin): bool
    {
        return true;
    }

    public function update(SuperAdmin $superAdmin): bool
    {
        return true;
    }

    public function delete(SuperAdmin $superAdmin): bool
    {
        return true;
    }
}
