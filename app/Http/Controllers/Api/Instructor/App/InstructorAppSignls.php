<?php

namespace App\Http\Controllers\Api\Instructor\App;

use App\Models\User;
use App\Models\Offer;
use App\Policies\OfferPolicy;
use App\Http\Resources\OfferResource;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Notifications\NewDealUploadedNotification;

class InstructorAppSignls extends \Lynx\Base\Api
{
    protected $entity               = Offer::class;
    protected $resourcesJson        = OfferResource::class;
    protected $policy               = OfferPolicy::class;
    protected $guard                = 'instructor-api';
    protected $spatieQueryBuilder   = true;
    protected $paginateIndex        = true;
    protected $withTrashed          = false;
    protected $FullJsonInStore      = false;  // TRUE,FALSE
    protected $FullJsonInUpdate     = false;  // TRUE,FALSE
    protected $FullJsonInDestroy    = false;  // TRUE,FALSE

    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param $entity model
     * @return query by Model , Entity
     */
    public function query($entity): Object
    {
        return $entity->where('instructor_id', auth('instructor-api')->id());
    }

    /**
     * this method append data when store or update data
     * @return array
     */
    public function append(): array
    {
        $data = [
            'instructor_id' => auth('instructor-api')->id(),
        ];
        // $file = lynx()->uploadFile('file', 'test');
        // if (!empty($file)) {
        //     $data['file'] = $file;
        // }
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
            'order_status'     => 'sometimes|nullable|string',
            'pair'             => 'sometimes|nullable|string|max:255',
            'price'            => 'sometimes|nullable|string',
            'order_type'       => 'sometimes|nullable|string|max:255',
            'sl'               => 'sometimes|nullable|string',
            'tp1'              => 'sometimes|nullable|string',
            'tp2'              => 'sometimes|nullable|string',
            'tp3'              => 'sometimes|nullable|string',
            'tp4'              => 'sometimes|nullable|string',
            'tp5'              => 'sometimes|nullable|string',
            'chart'            => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'      => 'sometimes|nullable|string|max:500',
        ] : [
            'order_status'     => 'sometimes|nullable|string',
            'pair'             => 'sometimes|nullable|string|max:255',
            'price'            => 'sometimes|nullable|string',
            'order_type'       => 'sometimes|nullable|string|max:255',
            'sl'               => 'sometimes|nullable|string',
            'tp1'              => 'sometimes|nullable|string',
            'tp2'              => 'sometimes|nullable|string',
            'tp3'              => 'sometimes|nullable|string',
            'tp4'              => 'sometimes|nullable|string',
            'tp5'              => 'sometimes|nullable|string',
            'chart'            => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'      => 'sometimes|nullable|string|max:500',
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
        $user = auth('instructor-api')->user();
        // dd($user->addresse);

        return $data;
    }

    /**
     * this method can use or append store data
     * @return array
     */
    public function afterStore($entity): void
    {
        // dd($entity->id);
        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewDealUploadedNotification($entity, $user_id));
        }


        $title = 'Notification for offer';
        $body = "offer pair: " . $entity->pair;
        $offer_id = $entity->id;

        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->filter()->toArray();

        if (!empty($tokens)) {

            // Create a CloudMessage instance
            $message = CloudMessage::new()
                ->withNotification([
                    'title' => $title,
                    'body' => $body,
                    'offer_id' => $offer_id
                ]);

            // Send the message as a multicast to all FCM tokens
            $report = Firebase::messaging()->sendMulticast($message, $tokens);
        }
    }

    /**
     * this method use or append or delete data beforeUpdate
     * @return array
     */
    public function beforeUpdate($entity): void
    {
        $user = auth('instructor-api')->user();
        // dd(request('is_main') == 'yes');
        if (request('is_main') == 'yes')
            // dd($user->addresse?->update(['is_main' => 'no']));
            $user->addresse?->update(['is_main' => 'no']);
    }

    /**
     * this method use or append data after Update
     * @return array
     */
    public function afterUpdate($entity): void
    {
        // dd($entity->id);
        // dd($entity->id);
        $users = User::all();
        foreach ($users as $user) {
            $user_id = $user->id;
            $user->notify(new NewDealUploadedNotification($entity, $user_id));
        }


        $title = 'Notification for offer';
        $body = "offer pair: " . $entity->pair;
        $offer_id = $entity->id;

        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->filter()->toArray();

        if (!empty($tokens)) {

            // Create a CloudMessage instance
            $message = CloudMessage::new()
                ->withNotification([
                    'title' => $title,
                    'body' => $body,
                    'offer_id' => $offer_id
                ]);

            // Send the message as a multicast to all FCM tokens
            $report = Firebase::messaging()->sendMulticast($message, $tokens);
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
        return new OfferResource($entity);
    }

    /**
     * you can do something in this method before delete record
     * @param object $entity
     * @return void
     */
    public function beforeDestroy($entity): void
    {
        // 
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
