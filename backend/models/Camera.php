<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tv_camera}}".
 *
 * @property integer $id
 * @property integer $com_id
 * @property integer $node_id
 * @property string $status
 * @property string $data
 */
class Camera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tv_camera}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_id'], 'required'],
            [['com_id', 'node_id'], 'integer'],
            [['data'], 'string'],
            [['status'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'com_id' => 'Com ID',
            'node_id' => 'Node ID',
            'status' => 'Status',
            'data' => 'Data',
        ];
    }

    /*
    * Set Camera Redis
    */
    public function setCameraRedis(){
        Yii::$app->cache->redis->set('time',time());        //保存该单位最后修改的时间信息
        Yii::$app->cache->redis->hmset(
            'node'.$this->node_id.':camera'.$this->id,    //'com:'.$this->id,Redis的哈希键值对的集合，对于Redis命令 com:1 是键
            'id',$this->id,
            'com_id',$this->com_id,
            'node_id',$this->node_id,
            'status',$this->status,
            'data',$this->data
        );
    }

    /*
     * Get Company Redis
     */
    public function getCameraRedis($node_id,$camera_id){

        return Yii::$app->cache->redis->HGETALL('node'.$node_id.':camera'.$camera_id);
        exit;
        $redis_arr = [];
        $redis_arr['id'] = Yii::$app->cache->redis->HGET('node:'.$node_id,'id');
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
    public function delCameraRedis($node_id){
        Yii::$app->cache->redis->del('time');
        Yii::$app->cache->redis->del('node'.$node_id.':camera'.$this->id);
    }

    /*
     * Get Company Redis
     */
    public function getAllRedis($node_arr){
        //这里接受的#node_arr是一个数组，遍历查询哦
        foreach($node_arr as $node){
            foreach(Yii::$app->cache->redis->KEYS('node'.$node.':camera*') as $key){
                $camera_arr[] = [
                    'id' => Yii::$app->cache->redis->HGET($key,'id'),
                    'com_id' => Yii::$app->cache->redis->HGET($key,'com_id'),
                    'node_id' => Yii::$app->cache->redis->HGET($key,'node_id'),
                    'status' => Yii::$app->cache->redis->HGET($key,'status'),
                    'data' => Yii::$app->cache->redis->HGET($key,'data'),
                ];
            };
        }
        return $camera_arr;
    }
}
