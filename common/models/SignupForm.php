<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $status = User::STATUS_ACTIVE;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username'], 'string', 'min' => 3, 'max' => 255],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
        ];
    }

    /**
     * Signs up a user.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->password_hash = User::generatePasswordHash($this->password);
        $user->generateAuthKey();
        $user->generateVerificationToken();

        if ($user->save()) {
            return $user;
        }

        return null;
    }
}
