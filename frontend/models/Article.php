<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property integer $uid
 * @property integer $tid
 * @property integer $addtime
 * @property string $content
 * @property string $keyword
 * @property integer $rtime
 * @property string $replay
 * @property string $isbest
 * @property string $status
 * @property string $remind
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'tid', 'content', 'replay'], 'required'],
            [['uid', 'tid', 'addtime', 'rtime'], 'integer'],
            [['content', 'replay', 'isbest', 'status', 'remind'], 'string'],
            [['keyword'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'tid' => 'Tid',
            'addtime' => 'Addtime',
            'content' => 'Content',
            'keyword' => 'Keyword',
            'rtime' => 'Rtime',
            'replay' => 'Replay',
            'isbest' => 'Isbest',
            'status' => 'Status',
            'remind' => 'Remind',
        ];
    }

//    public function fields(){
//        return [
//            // 字段名和属性名相同
//            'id',
//            // 字段名为"email", 对应的属性名为"email_address"
//            'uid' => 'user_id',
//            // 字段名为"name", 值由一个PHP回调函数定义
//            'addtime' => function ($model) {
//                return $model->addtime . ' ' . $model->addtime;
//            },
//        ];
//    }
}
