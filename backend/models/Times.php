<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tv_times}}".
 *
 * @property integer $id
 * @property integer $node_id
 * @property string $star_time
 * @property string $end_time
 */
class Times extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tv_times}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['star_time', 'end_time'], 'required'],
            [['star_time', 'end_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'node_id' => '节点ID',
            'star_time' => '开始时间',
            'end_time' => '结束时间',
        ];
    }

    /*
   * Set Times Redis
   */
    public function setTimesRedis(){
        Yii::$app->cache->redis->set('time', time()); //节点最后修改的时间信息
        Yii::$app->cache->redis->hmset(
            'node'.$this->node_id.':times'.$this->id,
            'id',$this->id,
            'node_id',$this->node_id,
            'star_time',$this->star_time,
            'end_time',$this->end_time
        );
    }

    /*
     * Get Times Redis
     */
    public function getTimesRedis($id){
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
     * Delete Times Redis
     */
    public function delTimesRedis($id){
        Yii::$app->cache->redis->del('time');
        Yii::$app->cache->redis->del('node'.$id.':times'.$this->id);
    }

    /*
     * Get All Times Redis
     */
    public function getAllRedis($node_arr){
        foreach($node_arr as $node_id){
            foreach(Yii::$app->cache->redis->KEYS('node'.$node_id.':times*') as $times){
                $time_arr[] = [
                    'id'         => Yii::$app->cache->redis->HGET($times,'id'),
                    'node_id'    => Yii::$app->cache->redis->HGET($times,'node_id'),
                    'star_time'  => Yii::$app->cache->redis->HGET($times,'star_time'),
                    'end_time'   => Yii::$app->cache->redis->HGET($times,'end_time')
                ];
            }
        }
        return $time_arr;
    }
}
