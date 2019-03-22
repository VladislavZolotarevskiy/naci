<?php
namespace frontend\modules\user\models;

use yii\base\Model;
use frontend\models\User;
use Yii;
/**
 * Signup form
 */
class ManageUser extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $admin;
    public $id;
    
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
            'email' => 'E-mail',
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
        if ($this->admin == 1) {
            $userRole = Yii::$app->authManager->getRole('admin');
        }
        else {
            $userRole = Yii::$app->authManager->getRole('user');
        }
        if ($user->save() && Yii::$app->authManager->assign($userRole, $user->id)) {
            return $user;
        }
        else {
            return null;
        }
    }
    
    public function updateUser($model)
    {
        $user = ManageUser::findModel($model->id);
        $user->first_name = $model->first_name;
        $user->middle_name = $model->middle_name;
        $user->last_name = $model->last_name;
        $user->admin = $model->admin;
        $user->username = $model->username;
        $user->email = $model->email;
        Yii::$app->authManager->revokeAll($user->id);
        if ($model->admin == 1) {
            $userRole = Yii::$app->authManager->getRole('admin');
        }
        else {
            $userRole = Yii::$app->authManager->getRole('user');
        }
        if ($user->save() && Yii::$app->authManager->assign($userRole, $user->id)){
        return true;
        }
    }
    public function selfUpdateUser($model)
    {
        $user = ManageUser::findModel($model->id);
        $user->first_name = $model->first_name;
        $user->middle_name = $model->middle_name;
        $user->last_name = $model->last_name;
        $user->username = $model->username;
        $user->email = $model->email;
        if ($user->save()){
        return true;
        }
    }
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
    }
    
    public function deleteUser($id) 
    {
        ManageUser::findModel($id)->delete();

        return true;
    }

    public function findUser($id)
    {
        if (($user = User::findOne($id)) !== null) {
            $model = new ManageUser;
            $model->first_name = $user->first_name;
            $model->middle_name = $user->middle_name;
            $model->last_name = $user->last_name;
            $model->admin = $user->admin;
            $model->id = $user->id;
            $model->username = $user->username;
            $model->email = $user->email;
            
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function changePassword($model){
        $user = User::findOne($model->id);
        $user->setPassword($model->password);
        return $user->save();
    }
}
