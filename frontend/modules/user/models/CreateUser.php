<?php
namespace frontend\modules\user\models;

use yii\base\Model;
use frontend\models\User;

/**
 * Signup form
 */
class CreateUser extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $admin;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Это имя пользователя уже используется.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Этот e-mail уже используется.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['first_name', 'required'],
            ['first_name','string', 'min' => 2, 'max' => 50],
            ['middle_name', 'required'],
            ['middle_name', 'string', 'min' => 2, 'max' => 50],
            ['last_name', 'required'],
            ['last_name', 'string', 'min' => 2, 'max' => 50],
            ['admin', 'boolean']
        ];
    }
    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'username' => 'Имя пользователя',
            'email' => 'E-mail домена @nornik.ru',
            'password' => 'Пароль',
            'admin' => 'Администратор'
        ];
    }
    
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function createUser()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->middle_name = $this->middle_name;
        $user->last_name = $this->last_name;
        $user->admin = $this->admin;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
