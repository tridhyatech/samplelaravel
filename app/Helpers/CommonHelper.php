<?php
namespace App\Helpers;
  
class CommonHelper {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function convertTaskTime($hours = 0, $minutes = 0) {
        $resultHour = 0;
        if($minutes == '15'){
            $resultHour = $hours.'.25';
        }else if($minutes == '30'){
            $resultHour = $hours.'.50';
        }else if($minutes == '45'){
            $resultHour = $hours.'.75';
        }else{
            $resultHour = $hours.'.00';
        }
        
        return $resultHour;
    }

    public static function displayTaskTime($taskHours) {
        $resultHour = '';

        $taskHours = number_format($taskHours, 2);
        $timeLog = explode('.', $taskHours);
        
        if(!empty($timeLog) && isset($timeLog[0])){
            if(isset($timeLog[1]) && $timeLog[1] == '25'){
                $resultHour = $timeLog[0].':15';
            }else if(isset($timeLog[1]) && $timeLog[1] == '50'){
                $resultHour = $timeLog[0].':30';
            }else if(isset($timeLog[1]) && $timeLog[1] == '75'){
                $resultHour = $timeLog[0].':45';
            }else{
                $resultHour = $timeLog[0].':00';
            }
        }
        
        return $resultHour;
    }

    public static function displayDate($date) {

        $returnDate = date('d-m-Y', strtotime($date));
        
        return $returnDate;
    }
    public static function displayDay($date) {

        $returnDay = date('l', strtotime($date));
        
        return $returnDay;
    }
}