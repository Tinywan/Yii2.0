<?php

namespace backend\models;

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
            'id' => '问题id号',
            'uid' => '提问会员id号',
            'tid' => '被提问教师id号',
            'addtime' => '提问时间',
            'content' => '提问内容',
            'keyword' => '标签（关键字）',
            'rtime' => '回复时间',
            'replay' => '回复内容',
            'isbest' => '是否推荐',
            'status' => '状态0隐藏1显示',
            'remind' => '提醒0不提示1提示',
        ];
    }
}
