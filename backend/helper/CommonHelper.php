<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/5/22
 * Time: 12:53
 */
namespace backend\helpers;


class CommonHelper{

    public static function dateFormat($data,$format = 'json')
    {
        if($format == 'json'){
            return \yii\helpers\Json::encode($data);
        }
    }

    public static function validateDateTime($dateTime)
    {
        return $dateTime == date('Y-m-d H:i:s',strtotime($dateTime));
    }


}