<?php
/**
 * Created by PhpStorm.
 * User: tiywan
 * Date: 2016/5/21
 * Time: 16:31
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use \yii\helpers\FileHelper;
use yii\validators\ImageValidator;

class UploadForm extends Model{

    /**
     * @var UploadedFile file attribute
     */
    public $imageFile;

    public $created_at;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //上传文件不能为空type,skipOnEmpty上传的必须是文件，
            [['imageFile'], 'file', 'skipOnEmpty' => false,'skipOnError' => false],
            //[['file'], 'file', 'extensions' => ['png', 'jpg', 'gif'],'message'=>"没有上传或类型不符"],
            //[['file'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 10],
            [['imageFile'],
                'image',
                'notImage' => 1,
                'extensions' => 'png,jpg',
                'maxSize' => 1024*1024,
                'mimeTypes' => 'image/jpeg, image/png',
                'minWidth' => 50,
                'maxWidth' => 1000,
                'minHeight' => 50,
                'maxHeight' => 1000,
            ],
        ];
    }
}