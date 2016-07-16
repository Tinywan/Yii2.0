<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class CacheController extends Controller
{
   public function actionIndex(){
      echo '22222222222222';
   }

    /**
     * 文件缓存
     */
   public function actionDataCache(){
       // 获取缓存组件
       $cache = yii::$app->cache;

       // 往缓存中写入数据
       $cache->add('name','Tinywan');

       // 存贮之前，先查看有没有对应的数据，有则会存储，负责false
       // 以下语句不会覆盖以上的数据，因为已经存在了，要修改的用set()方法
       $cache->add('name','Tinywan22222');

       // 修改缓存数据
       $cache->set('name','wanwan');

       // 删除数据,
       $cache->delete('name');

       // 清空数据
       $cache->flush();

       // 取出缓存数据，如果被删除掉的话，则会返回布尔值 false
       var_dump($cache->get('name'));
   }

    /**
     * 文件缓存有效期
     */
    public function actionExpireCache(){
        // 获取缓存组件
        $cache = yii::$app->cache;

        // add（）设置有效期
        $cache->add('keys','Tinywan123123',15);

        // set（）设置有效期
        $cache->set('keys','Tinywan123123',15);

        // 取出缓存数据，如果被删除掉的话，则会返回布尔值 false
        var_dump($cache->get('keys'));
    }

    /**
     *  文件依赖
     */
    public function actionCacheDependency(){
        // 获取缓存组件
        $cache = yii::$app->cache;

        // 创建一个对 cache.txt 文件修改时间的缓存依赖
        $dependency = new \yii\caching\FileDependency(['fileName' => 'cache.txt']);

        // 缓存数据将在3000秒后超时
        // 如果 cache.txt 被修改，它也可能被更早地置为失效状态。
        //$cache->set('keys', 'actionCacheDependency', 3000, $dependency);

        // 缓存会检查数据是否已超时。
        // 它还会检查关联的依赖是否已变化。
        // 符合任何一个条件时都会返回 false。
        $data = $cache->get('keys');
        var_dump($data);
    }
}
