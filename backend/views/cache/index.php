<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/7/16
 * Time: 12:06
 */

 //缓存开关 true 开启 ，false 关闭
 $enabled = true;
 // 缓存时间
 $duration = 15;

 //文件依赖,只要改文件被修改，则缓存文件会失效
 $dependency = new \yii\caching\FileDependency(['fileName' => 'cache.txt']);

 //DB依赖..............

 // 判断该div是否已经被缓存
    // 缓存时间
//if($this->beginCache('cache-div',['duration'=>$duration])){
    // 缓存依赖
//if($this->beginCache('cache-div',['dependency'=>$dependency])){
   // 缓存开关
//if($this->beginCache('cache-div',['enabled'=>$enabled])){

if($this->beginCache('cache-div',[
    'enabled'=>$enabled,
    'dependency'=>$dependency
])){
?>
<div id="cache-div">
    <div>这里的数据会被缓存213</div>
</div>
<?php
    $this->endCache(); //记得结束缓存哦
    }
?>
<div id="no-cache-div">
    <div>这里的数据不会被缓存1111111</div>
</div>