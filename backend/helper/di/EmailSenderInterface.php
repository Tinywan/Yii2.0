<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/6/26
 * Time: 11:03
 * 为邮件服务定义抽象层
 */
namespace backend\helpers\di;

interface EmailSenderInterface{
    public function send();
}