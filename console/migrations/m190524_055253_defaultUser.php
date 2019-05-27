<?php

use yii\db\Migration;
use frontend\models\User;


/**
 * Class m190523_055253_defaultUser
 */
class m190524_055253_defaultUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Администратор';
        $user = Yii::$app->authManager->createRole('user');
        $user->description = 'Пользователь';
        Yii::$app->authManager->add($admin);
        Yii::$app->authManager->add($user);
        $adminRole = Yii::$app->authManager->getRole('admin');
        $userRole = Yii::$app->authManager->getRole('user');
        Yii::$app->authManager->addChild($userRole, $adminRole);
        $defaultUser = new User;
        $defaultUser->first_name = 'admin';
        $defaultUser->middle_name = 'admin';
        $defaultUser->last_name = 'admin';
        $defaultUser->username = 'admin';
        $defaultUser->email = 'admin@example.com';
        $defaultUser->password = 'admin';
        $defaultUser->generateAuthKey();
        $defaultUser->admin = 1;
        if ($defaultUser->save() && Yii::$app->authManager->assign($adminRole, $defaultUser->id)) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190523_055253_defaultUser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190523_055253_defaultUser cannot be reverted.\n";

        return false;
    }
    */
}
