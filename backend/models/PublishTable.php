<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%version_publish_table}}".
 *
 * @property integer $id
 * @property string $software_name
 * @property string $software_zh
 * @property string $version_num
 * @property string $size
 * @property string $download_num
 * @property string $url
 * @property string $publish_time
 * @property string $description
 * @property string $belongs_stage
 * @property string $sha1
 */
class PublishTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%version_publish_table}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['software_name', 'required', 'message' => 'Please choose a software_name.'],
            // 检查version_num是否大于等于 30
            ['version_num', 'compare', 'compareValue' => 30, 'operator' => '>='],

            // 若 "description" 为空，则将其设为 "USA"
            ['description', 'default', 'value' => 'USA'],
            [['description'], 'string'],

            [['software_name', 'version_num','software_zh', 'size', 'download_num', 'url', 'publish_time', 'belongs_stage', 'sha1'], 'required'],
            [['software_name', 'software_zh', 'size', 'download_num', 'url', 'publish_time', 'belongs_stage', 'sha1'], 'string', 'max' => 128],
            [['version_num'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'software_name' => 'Software Name',
            'software_zh' => 'Software Zh',
            'version_num' => 'Version Num',
            'size' => 'Size',
            'download_num' => 'Download Num',
            'url' => 'Url',
            'publish_time' => 'Publish Time',
            'description' => 'Description',
            'belongs_stage' => 'Belongs Stage',
            'sha1' => 'Sha1',
        ];
    }
}
