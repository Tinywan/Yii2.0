<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tv_cam_set".
 *
 * @property integer $id
 * @property integer $cam_id
 * @property string $ip
 * @property string $pixels
 * @property string $code_rate
 * @property string $frame_rate
 */
class CamSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tv_cam_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cam_id'], 'required'],
            [['cam_id'], 'integer'],
            [['ip', 'pixels', 'code_rate', 'frame_rate'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cam_id' => '摄像头ID',
            'ip' => 'ip地址',
            'pixels' => '分辨率',
            'code_rate' => '码率',
            'frame_rate' => '帧率',
        ];
    }

    /*
    * Set Redis
    */
    public function setCamRedis(){
        Yii::$app->cache->redis->set('time',time());        //保存该单位最后修改的时间信息
        Yii::$app->cache->redis->hmset(
            'camera'.$this->cam_id.':set'.$this->id,    //'com:'.$this->id,Redis的哈希键值对的集合，对于Redis命令 com:1 是键
            'id',$this->id,
            'cam_id',$this->cam_id,
            'ip',$this->ip,
            'pixels',$this->pixels,
            'code_rate',$this->code_rate,
            'frame_rate',$this->frame_rate
        );
    }

    /*
     * Get Redis
     */
    public function getRedis($id){
        $redis_arr = [];
        $redis_arr['id'] = Yii::$app->cache->redis->HGET('company:'.$id,'id');
        $redis_arr['name'] = Yii::$app->cache->redis->HGET('company:'.$id,'name');
        $redis_arr['adress'] = Yii::$app->cache->redis->HGET('company:'.$id,'adress');
        $redis_arr['phone'] = Yii::$app->cache->redis->HGET('company:'.$id,'phone');
        $redis_arr['node_count'] = Yii::$app->cache->redis->HGET('company:'.$id,'node_count');
        $redis_arr['cma_count'] = Yii::$app->cache->redis->HGET('company:'.$id,'cma_count');
        return $redis_arr;
    }

    /*
     * Delete Company Redis
     */
    public function delRedis($id){
        Yii::$app->cache->redis->del('time');
        Yii::$app->cache->redis->del('camera'.$id.':set'.$this->id);
    }

    public function getAllRedis($cam_arr){
        foreach($cam_arr as $cam_id){
            foreach(Yii::$app->cache->redis->KEYS('camera'.$cam_id.':set*') as $keys){
                $set_arr[] = [
                  'id'     => Yii::$app->cache->redis->HGET($keys,'id'),
                  'cam_id' => Yii::$app->cache->redis->HGET($keys,'cam_id'),
                  'ip'     => Yii::$app->cache->redis->HGET($keys,'ip'),
                  'pixels' => Yii::$app->cache->redis->HGET($keys,'pixels'),
                  'code_rate'  => Yii::$app->cache->redis->HGET($keys,'code_rate'),
                  'frame_rate' => Yii::$app->cache->redis->HGET($keys,'frame_rate'),
                ];
            }
        }
        return $set_arr;
    }
}
