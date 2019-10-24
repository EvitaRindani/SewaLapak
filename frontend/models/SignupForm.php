<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $nama_lengkap;
    public $username;
    public $email;
    public $password;
    public $no_hp;
    public $no_ktp;
    public $alamat;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['nama_lengkap', 'trim'],
            ['nama_lengkap', 'required'],
            ['nama_lengkap', 'string', 'min' => 2, 'max' => 255],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['no_hp', 'trim'],
            ['no_hp', 'required'],
            ['no_hp', 'string', 'min' => 2, 'max' => 255],
            ['no_ktp', 'trim'],
            ['no_ktp', 'required'],
            ['no_ktp', 'string', 'min' => 2, 'max' => 255],
            ['alamat', 'trim'],
            ['alamat', 'required'],
            ['alamat', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->nama_lengkap = $this->nama_lengkap;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->no_hp = $this->no_hp;
        $user->no_ktp = $this->no_ktp;
        $user->alamat = $this->alamat;

        return $user->save() ? $user : null;
    }

}
