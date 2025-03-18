<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Offer;
use App\Models\SuperAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(SuperAdmin $super_admin): bool
    {
        return true;
    }

    public function view(SuperAdmin $super_admin, Course $course): bool
    {
        return true;
    }

    public function create(SuperAdmin $super_admin): bool
    {
        return true;
    }

    public function update(SuperAdmin $super_admin, Course $course): bool
    {
        return true;
    }

    public function delete(SuperAdmin $super_admin, Course $course): bool
    {
        return true;
    }
}
