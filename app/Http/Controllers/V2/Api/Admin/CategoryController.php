<?php

namespace App\Http\Controllers\V2\Api\Admin;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use App\Http\Resources\ApiCategoryResource;

class CategoryController extends \Lynx\Base\Api
{
    protected $entity               = Category::class;
    protected $resourcesJson        = ApiCategoryResource::class;
    protected $policy               = CategoryPolicy::class;
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
        return $entity->orderBy('order', 'asc');
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
        // $file = lynx()->uploadFile('photo', 'courses/photo');
        // if (!empty($file)) {
        //     $data['photo'] = $file;
        // }
        // return $data;
        return [];
    }

    /**
     * @param $id integer if you want to use in update rules
     * @param string $type (store,update)
     * @return array by (store,update) type using $type variable
     */
    public function rules(string $type, mixed $id = null): array
    {
        return $type == 'store' ?  [
            'name'          => 'required|string|max:255|unique:categories,name',
            'order'         => 'required|numeric',
        ] : [
            'name'          => 'required|string|max:255|unique:categories,name,' . request('id'),
            'order'         => 'required|numeric',
        ];
    }


    /**
     * this method can use or append store data
     * @return array
     */
    public function afterStore($entity): void
    {
        // dd($entity->id);
        Category::where('order', '>=', $entity->order)->where('id', '!=', $entity->id)
            ->orderBy('order', 'asc')
            ->increment('order');
    }

    /**
     * this method use or append data after Update
     * @return array
     */
    public function afterUpdate($entity): void
    {
        Category::where('order', '>=', $entity->order)->where('id', '!=', $entity->id)
            ->orderBy('order', 'asc')
            ->increment('order');

        Category::where('order', '<=', $entity->order)->where('id', '!=', $entity->id)
            ->orderBy('order', 'asc')
            ->decrement('order');
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
        return new ApiCategoryResource($entity);
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
