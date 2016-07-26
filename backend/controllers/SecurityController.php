<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;



class SecurityController extends Controller
{
    /**
     * Csrf 的Post请求测试
     */
    public function actionCsrf()
    {

        if(Yii::$app->request->isPost){
            echo Yii::$app->request->post('title');
        }else{
            /**
             * 获取_csrf 的值
             * 1，这个值发送给客户端的时候回保存两份
             *    【1】保存在客户端本地的cookie中（是经过算法加密的）
             *    【2】一份在一个隐藏的表单中_csrf 跟随表单提交
             * 2，服务器接收到表单提交和cookie提交的csrf值，
             *    【1】首先会解密cookie中的csrf的值
             *    【2】和表单中提交的csrf的值进行比较
             */
            $csrfToken = Yii::$app->request->csrfToken;
            return $this->renderPartial('csrf',['csrfToken'=>$csrfToken]);
        }

    }

    /**
     * Sql 注入 YII的方法注入
     * PDO:占位符
     */
    public function actionSql(){
        // 新建一个查询生成器
        $users =(new \yii\db\Query())
            ->select('*')
            ->from('tv_company')
            ->where('name = :name',[':name'=>'阿麦科技'])
            ->one();
        print_r($users);
    }

    /**
     * 文件上传漏洞
     */
    public function actionUpload(){

    }

    /**
     * PHP输入流php://input的使用分析
     */
    public function actionInput()
    {
        if(Yii::$app->request->isPost){
            $content = file_get_contents('php://input');
            echo $content;
            die;
        }else{
            $csrfToken = Yii::$app->request->csrfToken;
            $r = print('0000000000').'<br/>';
            return $this->render('input',['csrfToken'=>$csrfToken]);
        }

    }
}
