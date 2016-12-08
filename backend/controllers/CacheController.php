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
    /**
     * 先与方法执行
     * 定义页面缓存
     * @return array
     */
    public function behaviors(){
        return [
            [
                'class'=>'yii\filters\PageCache', // 定义一个页面缓存
                'duration' => 600000,
                'only' => ['index'], //只有index操作才会被缓存
                'dependency'=>[
                    'class'=>'yii\caching\FileDependency', // 定义一个文件依赖缓存
                    'fileName' => 'cache.txt',
                ]

            ]
        ];
    }

    public function actionIndex()
    {
        echo '000000000';
    }

    /**
     * 文件缓存
     */
    public function actionDataCache()
    {
        // 获取缓存组件
        $cache = yii::$app->cache;

        // 往缓存中写入数据
        $cache->add('name', 'Tinywan');

        // 存贮之前，先查看有没有对应的数据，有则会存储，负责false
        // 以下语句不会覆盖以上的数据，因为已经存在了，要修改的用set()方法
        $cache->add('name', 'Tinywan22222');

        // 修改缓存数据
        $cache->set('name', 'wanwan');

        // 删除数据,
        $cache->delete('name');

        // 清空数据定义页面缓存
        $cache->flush();

        // 取出缓存数据，如果被删除掉的话，则会返回布尔值 false
        var_dump($cache->get('name'));
    }

    /**
     * 文件缓存有效期
     */
    public function actionExpireCache()
    {
        // 获取缓存组件
        $cache = yii::$app->cache;

        // add（）设置有效期
        $cache->add('keys', 'Tinywan123123', 15);

        // set（）设置有效期
        $cache->set('keys', 'Tinywan123123', 15);

        // 取出缓存数据，如果被删除掉的话，则会返回布尔值 false
        var_dump($cache->get('keys'));
    }

    /**
     *  文件依赖
     */
    public function actionCacheDependency()
    {
        // 获取缓存组件
        $cache = yii::$app->cache;

        /**
         * ===================================【文件依赖】===================================
         * 创建一个对 cache.txt 文件修改时间的缓存依赖
         */
        //$dependency = new \yii\caching\FileDependency(['fileName' => 'cache.txt']);

        // 缓存数据将在3000秒后超时
        // 如果 cache.txt 被修改，它也可能被更早地置为失效状态。
        //$cache->set('keys', 'actionCacheDependency', 3000, $dependency);

        // 缓存会检查数据是否已超时。
        // 它还会检查关联的依赖是否已变化。
        // 符合任何一个条件时都会返回 false。
        //$data = $cache->get('keys');

        /**
         * ==========================【表达式依赖】======================================
         *//* $dependency = new \yii\caching\ExpressionDependency(
            ['expression' => '\yii::$app->request->get("name")']
        )*/;

        //$cache->set('expression_keys', 'expression_keysCacheDependency', 3000, $dependency);

        //$name = \yii::$app->request->get("name");
        /**
         * 可以取出啦
         * http://127.0.0.1/yiiadvanced/backend/web/cache/cache-dependency?name=123
         * 取不出来
         * http://127.0.0.1/yiiadvanced/backend/web/cache/cache-dependency?name=123456
         *
         * 注意: 如果name=123 再次获取的话，还是可以获取到数据缓存的，也就是每个参数会有每个参数的缓存数据
         */
        //var_dump($cache->get('expression_keys'));

        /**
         * ===================================【DB数据库依赖】===================================
         * 说明：yiitv.tv_article
         *      [1] yiitv ==>数据库名
         *      [2] tv_article 完整的数据库表名
         * 操作:只要在该数据库的对应表中添加或者删除一条记录的话，则缓存会自动失效
         * 经验:修改数据库后，你重新添加原来数据缓存键的话，是添加不进去的，也就是没有缓存的，
         *     这时候要及时修改数据缓存keys
         *
         */
        $dependency = new \yii\caching\DbDependency(
            ['sql' => 'SELECT COUNT(*) FROM yiitv.tv_article']
        );

        $cache->add('db_keys1230', 'db_keysCacheDependency123', 3000, $dependency);
        var_dump($cache->get('db_keys1230'));
    }

    /**
     * 片段缓存
     */
    public function actionLocation(){

        // 打开指定的视图页面
        return $this->renderPartial('index');
    }

    
}
