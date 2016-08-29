<?php

namespace Modules\Quotes\Repositories\Common;

use Illuminate\Http\JsonResponse;
use Modules\Quotes\Repositories\QuoteActivityRepo;
class Common {

    public static function getJsonResponse($success, $data, $status) {
        return JsonResponse::create([
                    'success' => $success,
                    'data' => $data
                        ], $status);
    }

    public static function searchArray($array, $key, $value) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, Common::searchArray($subarray, $key, $value));
            }
        }

        return $results;
    }
    
    public static function createActivityLog($category,$category_id,$log_type,$description,$user_name,$notes)
    {        
        $activityRepo=new QuoteActivityRepo;        
        $activity=new \stdClass();
        $activity->category=$category;;
        $activity->category_id=$category_id;
        $activity->log_type=$log_type;
        $activity->description=$description;
        $activity->user_name=$user_name;
        $activity->notes=$notes;
        $activityRepo->createActivityLog($activity);
    }

}
