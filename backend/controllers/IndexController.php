<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use Yii;
use yii\base\Object;
use yii\db\Connection;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use yii\log\FileTarget;
use yii\di\Container;
use yii\di\ServiceLocator;

/**
 * Site controller
 */
class IndexController extends Controller
{
    //使用容器Container 123
    public function actionContainer()
    {
        $container = new Container;

        $container->set('yii\db\Connection', [
            'dsn' => ''
        ]);
        //使用容器Container解决类与类之间的强依赖关系
        $container->set('backend\controllers\DriverInterface', [
            'class' => 'backend\controllers\ManDriver'
        ]);

        //注册一个容器
        $container->set('car', 'backend\controllers\Car');

        //返回一个类的请求实例
        $car = $container->get('backend\controllers\car');
        /* 相当于一下三句话:
        *
        *  $db = new \yii\db\Connection(['dsn' => '...']);
        *  $driver = new ManDriver($db);
        *  $car = new Car($driver)
        */
        $car->run();
    }

    //服务定位器 ServiceLocator
    public function actionService()
    {
        // 使用服务定位器的，如果这个类是实现某一个接口的话，则直接使用容器解决他们的依赖关系，才可以使用服务定位器
        yii::$container->set('backend\controllers\DriverInterface', 'backend\controllers\ManDriver');
        //这里使用之前必须在配置文件的组件中进行配置哦
        yii::$app->car->run();

//        $locator = new ServiceLocator;
//        //
//        $locator->setComponents([
//            'car' => [
//                'class' => 'backend\controllers\Car'
//            ],
//            'db' => [
//                'class' => 'yii\db\Connection',
//                'dsn' => 'sqlite:path/to/file.db'
//            ],
//        ]);
////        $locator->set('car',[
////            'class' => 'backend\controllers\Car'
////        ]);
//        $car = $locator->get('car');
//        $car->run();

    }
}

//定义这个接口是为了解决 ManDriver 和 Car之间的强依赖关系
interface DriverInterface
{
    public function driver();
}

class ManDriver extends Object implements DriverInterface
{
    public $db;

    public function __construct(Connection $db, $config = [])
    {
        $this->db = $db;
        parent::__construct($config);
    }

    public function driver()
    {
        echo 'I am a old man';
    }
}

class Car extends Object
{
    private $_driver;

    //Driver 注意这里的变化哦！
    public function __construct(DriverInterface $driver, $config = [])
    {
        $this->_driver = $driver;
        parent::__construct($config);
    }

    public function run()
    {
        $this->_driver->driver();
    }
}