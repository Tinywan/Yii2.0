<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Admin;

/**
 * Login form
 */
class LoginForm extends Model
{
    //这三个属性是和表单提交的数据一一对应的，这样直接可以通过load（）加载
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username 和 password 都是必填项
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // 用 validatePassword() 验证 password
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 当一个用户尝试登录时，表单提交的密码需要使用之前的存储的哈希串来验证：
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '错误的用户或者密码.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        //$this->validate() 相当于执行rules（）规则
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }

        return $this->_user;
    }

    protected function afterLogin(){
        Admin::EVENT_BEFORE_VALIDATE;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '账号名称',
            'password' => '密码',
            'rememberMe' => '记住'
        ];
    }
}
