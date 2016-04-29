<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginUserForm extends Model
{
    public $id;
    public $redis_host;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'redis_host'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'ip' => '单位IP',
            'redis_host' => 'Redis服务器',

        ];
    }
    //判断单位信息是否在Redis存在
    public function checkRedis(){
        $model = Yii::$app->cache->redis->EXISTS('company:'.$this->id); //获取到的是一个数组
        if(empty($model)){
            return false;
        }else{
            return true;
        }

    }

}
