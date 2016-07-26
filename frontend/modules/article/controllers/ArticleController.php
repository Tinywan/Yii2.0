<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/6/19
 * Time: 18:28
 * 看到没有在这个的article没有s
 */

namespace frontend\modules\article\controllers;

use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;

class ArticleController extends ActiveController
{
    public $modelClass = 'frontend\models\Article';

    //数据序列化
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //RESTful APIs 同时支持JSON和XML格式
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_XML,
                // 'application/xml' => Response::FORMAT_XML,
            ],
        ];

//        $behaviors['authenticator'] = [
//            'class' => CompositeAuth::className(),
//            'authMethods' => [
//                HttpBasicAuth::className(),
//                HttpBearerAuth::className(),
//                QueryParamAuth::className(),
//            ],
//        ];
        return $behaviors;
    }

    //    public function actions()
//    {
//        $actions = parent::actions();
//
//        // 禁用"delete" 和 "create" 操作
//        unset($actions['delete'], $actions['create']);
//
//        // 使用"prepareDataProvider()"方法自定义数据provider
//        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//
//        return $actions;;
//    }

     //执行访问检查
     public function checkAccess($action, $model = null, $params = [])
     {
         // 检查用户能否访问 $action 和 $model
         // 访问被拒绝应抛出ForbiddenHttpException
     }

    public function fields()
    {
        $fields = parent::fields();

        // 删除一些包含敏感信息的字段
        unset($fields['uid'], $fields['content'], $fields['password_reset_token']);

        return $fields;
    }

    public function actionIndex()
    {
        echo 'actionIndex';
    }



}