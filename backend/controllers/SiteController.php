<?php
namespace backend\controllers;

use common\models\Admin;
use Yii;
//AccessControl提供基于yii\filters\AccessControl::rules规则的访问控制
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use yii\log\FileTarget;

use backend\models\UploadForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use common\myhelper\MyHelper;
use common\commonfunction\HelpFunction;

use  yii\i18n\Formatter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     *  过滤器本质上是一类特殊的 行为
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 //允许已认证用户访问create 和 update 动作，拒绝其他用户访问这两个动作。
                 //'only' => ['create', 'update'],
                 'rules' => [
                        // 默认禁止其他用户
                     [
                         'actions' => ['login', 'error'],
                         'allow' => true,
                         'roles' => ['?'],
                     ],
                        // 允许认证用户
                     [
                         'actions' => ['logout', 'index','upload','password','data','language','test'],
                         'allow' => true,
                         'roles' => ['@'],
                     ],
                 ],
             ],
             //VerbFilter检查请求动作的HTTP请求方式是否允许执行，如果不允许，会抛出HTTP 405异常。 如下示例，VerbFilter指定CRUD动作所允许的请求方式
//             'verbs' => [
//                 'class' => VerbFilter::className(),
//                 'actions' => [
//                     'logout' => ['post'],
//                 ],
//             ],
             //PageCache应用在index动作， 缓存整个页面60秒或post表的记录数发生变化。它也会根据不同应用语言保存不同的页面版本。
            //  'pageCache' => [
            //     'class' => PageCache::className(),
            //     'only' => ['index'],
            //     'duration' => 60,
            //     'dependency' => [
            //         'class' => DbDependency::className(),
            //         'sql' => 'SELECT COUNT(*) FROM post',
            //     ],
            //     'variations' => [
            //         \Yii::$app->language,
            //     ]
            // ],
         ];
     }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
//        $isGuest = \Yii::$app->user->isGuest;
//        if(!\Yii::$app->user->isGuest) {
//            return \Yii::$app->getResponse()->redirect(Url::to('@web/company/index'));
//        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            // 不是游客返回主页
            // return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            // Yii::$app->getHomeUrl() 是 yiiadvanced/backend/web/
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //$this->redirect(['site/index']);
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionModule(){
        //获取子模块
        $article = Yii::$app->getModule('category');

        //通过子模块调用该模块的操作
        $article->runAction('default/index');
    }

    /*
     * uploads 这个文件夹在web目录下面
     *
     *
     * */
    public function actionUpload()
    {
        //获取session
        $session = Yii::$app->session;
        $session->open();
//        $user_id = $session->hasSessionId;
//        $db = Admin::find()->where(['id'=>$user_id])->asarray()->one();
//        $user_name = $db['username'];
        $model = new UploadForm();

       if(Yii::$app->request->isPost){
           //getInstance 返回一个上传文件的实例
           $model->imageFile = UploadedFile::getInstance($model,'imageFile');
//            var_dump($image->type);
//           exit();
           //返回空数组如果没有可用的文件被发现对于给定的属性 @return null
           if($model->imageFile == Null){
               Yii::$app->getSession()->setFlash('error', '上传文件不能为空');
               return \Yii::$app->getResponse()->redirect(Url::to());
           }

           if(($model->imageFile->type != 'image/jpeg') && ($model->imageFile->type != 'image/png')){
               Yii::$app->getSession()->setFlash('error', '只能上传图片');
               return \Yii::$app->getResponse()->redirect(Url::to());
           }
           //$ext = $image->getExtension();
           // 如果有文件上传
           if(($model->imageFile !=Null) && $model->validate()){
                $preRand = 'img_'.date('Y-m-d',time()).mt_rand(0,999);
                $imgName = $preRand.'.'.$model->imageFile->getExtension();

                //如果上传成功则返回 1 ，否则：0
                $result = $model->imageFile->saveAs('statics/uploads/'.$imgName);
                // 保存在数据库中
                //$model->sqlName = $imgName;
               if($result>0){
                   $this->refresh();
                   Yii::$app->getSession()->setFlash('success', '添加成功');
                   return \Yii::$app->getResponse()->redirect(Url::to());
               }else{
                   Yii::$app->getSession()->setFlash('error', '添加失败');
                   return \Yii::$app->getResponse()->redirect(Url::to());
               }
           }
       }
        return $this->render('upload',['model' => $model]);
    }

    public function actionPassword(){
//        $userInfo = Yii::$app->user->getId();
//        //$userName = $userInfo->username;
//
//        // 更新主键为$id的AR
//        $model = Admin::findOne($userInfo);
//        if($model === null ){
//            throw new NotFoundHttpException;
//        }
//        $model->username = 'admin';
//        if($model->load(Yii::$app->request->post()) && $model->save()){
//            echo '1';
//        }
//        Yii::$app->getSession()->setFlash('');
        $result = array(1,2,3,4,4);
        HelpFunction::p($result);

    }

    // 格式化时间
     public function actionData(){
       echo Yii::$app->formatter->asDate('2014-01-01', 'long')."<br/>";
       echo Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'); // 2014-10-06
    }

    //语言切换
    public function actionLanguage(){
        if(isset($_REQUEST['lang'])&&$_REQUEST['lang']!=""){
            Yii::$app->language = $_REQUEST['lang'];
            setcookie('lang',$_REQUEST['lang'],time()+3600*24*7,'/');
        }
        $this->redirect(['company/index']);
    }

    public function actionTest(){
        $loginRequired = Yii::$app->user->loginRequired();
        var_dump($loginRequired);
    }
}
