<?php

namespace App\Http\Controllers\V2\Api\Admin;

use App\Models\Course;
use Illuminate\Support\Str;
use App\Policies\CoursePolicy;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ApiCoursesResource;

class CourseController extends \Lynx\Base\Api
{
    protected $entity               = Course::class;
    protected $resourcesJson        = ApiCoursesResource::class;
    protected $policy               = CoursePolicy::class;
    protected $guard                = 'admin';
    protected $spatieQueryBuilder   = true;
    protected $paginateIndex        = true;
    protected $withTrashed          = false;
    protected $FullJsonInStore      = true;  // TRUE,FALSE
    protected $FullJsonInUpdate     = true;  // TRUE,FALSE
    protected $FullJsonInDestroy    = false;  // TRUE,FALSE

    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param $entity model
     * @return query by Model , Entity
     */
    public function query($entity): Object
    {
        return $entity;
    }

    /**
     * this method append data when store or update data
     * @return array
     */
    public function append(): array
    {
        // $data = [
        //     'user_id' => auth('api')->id(),
        // ];
        $file = lynx()->uploadFile('photo', 'courses/photo');
        if (!empty($file)) {
            $data['photo'] = $file;
        }
        return $data;
        // return [];
    }

    /**
     * @param $id integer if you want to use in update rules
     * @param string $type (store,update)
     * @return array by (store,update) type using $type variable
     */
    public function rules(string $type, mixed $id = null): array
    {
        return $type == 'store' ?  [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:500',
            'total_hours'    => 'required|numeric|min:0',
            'instructor_id'  => 'required|exists:instructors,id',
            'category_id'    => 'required|exists:categories,id',
            'photo'          => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ] : [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:500',
            'total_hours'    => 'required|numeric|min:0',
            'instructor_id'  => 'required|exists:instructors,id',
            'category_id'    => 'required|exists:categories,id',
            'photo'          => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * this method can set your attribute names with validation rules
     * @return array
     */
    public function niceName()
    {
        return [];
    }

    /*
     * this method use or append or change data before store
     * @return array
     */
    public function beforeStore(array $data): array
    {
        // $data['title'] = 'replace data';
        return $data;
    }

    /**
     * this method can use or append store data
     * @return array
     */
    public function afterStore($entity): void
    {
        // dd($entity->id);
    }

    /**
     * this method use or append or delete data beforeUpdate
     * @return array
     */
    public function beforeUpdate($entity): void
    {
        // dd(url($entity->photo));
        // dd(file_exists('storage/' . $entity->photo));

        if (request()->hasFile('photo')) {
            if (!empty($entity->photo)) {
                Storage::disk('public')->delete($entity->photo);
            }
        }
    }

    /**
     * this method use or append data after Update
     * @return array
     */
    public function afterUpdate($entity): void
    {
        $file = lynx()->uploadFile('photo', 'courses/photo');
        if (!empty($file)) {
            $entity->update(['photo' => $file]);
            // dd($entity);
        }
    }

    /**
     * this method use or append data when Show data
     * @return array
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

    /**
     * this method use or append data when Show data
     * @return array
     */
    public function afterShow($entity): Object
    {
        return new ApiCoursesResource($entity);
    }

    /**
     * you can do something in this method before delete record
     * @param object $entity
     * @return void
     */
    public function beforeDestroy($entity): void
    {
        if (!empty($entity->photo)) {
            Storage::disk('public')->delete($entity->photo);
        }
    }

    /**
     * you can do something in this method after delete record
     * @param object $entity
     * @return void
     */
    public function afterDestroy($entity): void
    {
        // do something
        // $entity->file
    }
}
