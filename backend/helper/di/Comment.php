<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/6/26
 * Time: 11:07
 * 上面的代码对比原来的代码，解决了Comment类对于GmailSender等具体类的依赖，
 * 通过构造函数，将相应的实现了 EmailSenderInterface接口的类实例传入Comment类中，
 * 使得Comment类可以适用于不同的邮件服务。 从此以后，无论要使用何何种邮件服务，
 * 只需写出新的EmailSenderInterface实现即可， Comment类的代码不再需要作任何更改，
 * 多爽的一件事，扩展起来、测试起来都省心省力。
 */

namespace backend\helpers\di;

use yii\db\ActiveRecord;
class Comment extends ActiveRecord
{
    // 用于引用发送邮件的库
    private $_eMailSender;

    // 构造函数注入
    public function  __construct($emailSender)
    {
        $this->_eMailSender = $emailSender;
    }

    // 当有新的评价，即 save() 方法被调用之后中，会触发以下方法

    public function afterInsert()
    {
        //$this->_eMailSender->send();
    }
}

// 实例化两种不同的邮件服务，当然，他们都实现了EmailSenderInterface
$sender1 = new GmailSender();
// 用构造函数将GmailSender注入
$comment1 = new Comment($sender1);

// 使用Gmail发送邮件
$comment1->afterInsert();