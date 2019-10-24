<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $nama_lengkap
 * @property string $username
 * @property string $email
 * @property string $no_hp
 * @property string $no_ktp
 * @property string $alamat
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Pemesanan[] $pemesanans
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nama_lengkap', 'username', 'email', 'no_hp', 'no_ktp', 'alamat', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['nama_lengkap', 'username', 'email', 'no_hp', 'no_ktp', 'alamat', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nama_lengkap' => 'Nama Lengkap',
            'username' => 'Username',
            'email' => 'Email',
            'no_hp' => 'No Hp',
            'no_ktp' => 'No Ktp',
            'alamat' => 'Alamat',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemesanans() {
        return $this->hasMany(Pemesanan::className(), ['user_id' => 'id']);
    }

    public function namaPengguna($id) {
        $user = User::find()->where(['id' => $id])->one();
        return $user->nama_lengkap;
    }

}
