<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/6/26
 * Time: 11:04
 * 定义Gmail邮件服务
 */
namespace backend\helpers\di;

class GmailSender implements EmailSenderInterface
{
    // 实现发送邮件的类方法
    public function send()
    {
        echo 'I is '.__CLASS__;
    }
}