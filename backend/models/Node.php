<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tv_node".
 *
 * @property integer $id
 * @property integer $com_id
 * @property integer $cam_id
 * @property string $data
 */
class Node extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tv_node';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_id'], 'required'],
            [['com_id', 'cam_id'], 'integer'],
            [['data'], 'string']
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
            'cam_id' => 'Cam ID',
            'cam_num' => 'Cam NUM',
            'data' => 'Data',
        ];
    }

    /*
    * Set Node Redis
    */
    public function setNodeRedis(){
        Yii::$app->cache->redis->set('time', time()); //保存该单位最后修改的时间信息
        Yii::$app->cache->redis->hmset(
            'company'.$this->com_id.':node'.$this->id,
            'id',$this->id,
            'com_id',$this->com_id,
            'cam_id',$this->cam_id,
            'cam_num',$this->cam_num,
            'data',$this->data
        );
    }

    /*
     * Get Node Redis
     */
    public function getNodeRedis($id){
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
    public function delNodeRedis($com_id){
        Yii::$app->cache->redis->del('time');
        Yii::$app->cache->redis->del('company'.$com_id.':node'.$this->id);
    }

    /*
    * Get All Node Redis
    */
    public function getAllRedis($id){
        //keys
       $keys = Yii::$app->cache->redis->keys('company'.$id.':node*');
       if($keys){
           foreach($keys as $key){
               $node_arr[] = [
                   'id' => Yii::$app->cache->redis->HGET($key,'id'),
                   'com_id' => Yii::$app->cache->redis->HGET($key,'com_id'),
                   'cam_id' => Yii::$app->cache->redis->HGET($key,'cam_id'),
                   'cam_num' => Yii::$app->cache->redis->HGET($key,'cam_num'),
                   'data' => Yii::$app->cache->redis->HGET($key,'data'),
               ];
           }
           return $node_arr;
       }else{
           return $node_arr = [];
       }
    }

    //浏览器输出格式
    public static function browser_export($type,$filename){
        if($type=="Excel5"){
            header('Content-Type: application/vnd.ms-excel');//告诉浏览器将要输出excel03文件
        }else{
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器数据excel07文件
        }
        header('Content-Disposition: attachment;filename="'.$filename.'"');//告诉浏览器将输出文件的名称
        header('Cache-Control: max-age=0');//禁止缓存
    }
}
