<?php

namespace App\Http\Controllers\V2\Api\Admin;

use App\Models\Instructor;
use App\Policies\InstructorPolicy;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\InstructorResource;
use Termwind\Components\Dd;

class InstructorController extends \Lynx\Base\Api
{
    protected $entity               = Instructor::class;
    protected $resourcesJson        = InstructorResource::class;
    protected $policy               = InstructorPolicy::class;
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
        $file = lynx()->uploadFile('photo', 'instructors/photo');
        if (!empty($file)) {
            $data['photo'] = $file;
        }
        // dd($data);
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
        return $type == 'store' ? [
            'name'        => 'required|string',
            'email'       => 'required|email|unique:instructors,email',
            'password'    => 'required|string',
            'position'    => 'required|string',
            'description' => 'required|string',
            'photo'       => 'required|image',
            'status'      => 'required|in:active,inactive',
            'video'       => 'required|url',
        ] : [
            'name'        => 'required|string',
            'email'       => 'required|email|unique:instructors,email,' . request('id'),
            'password'    => 'sometimes|nullable|string',
            'position'    => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'photo'       => 'sometimes|nullable|image',
            'status'      => 'required|in:active,inactive',
            'video'       => 'sometimes|nullable|url',
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
        $data['password'] = bcrypt(request('password'));

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

        // dd($entity);
        // if (!empty($entity->file)) {
        //     Storage::delete($entity->file);
        // }
    }

    /**
     * this method use or append data after Update
     * @return array
     */
    public function afterUpdate($entity): void
    {
        $entity->password = bcrypt(request('password'));
        $entity->save();
        // dd($entity);
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
        return new InstructorResource($entity);
    }

    /**
     * you can do something in this method before delete record
     * @param object $entity
     * @return void
     */
    public function beforeDestroy($entity): void
    {
        if (!empty($entity->file)) {
            Storage::delete($entity->file);
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
