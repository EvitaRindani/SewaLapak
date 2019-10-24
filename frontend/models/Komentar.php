<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "komentar".
 *
 * @property integer $id
 * @property string $username
 * @property string $lapak
 * @property string $komentar
 */
class Komentar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'komentar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'lapak', 'komentar'], 'required'],
            [['komentar'], 'string'],
            [['username', 'lapak'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'lapak' => 'Lapak',
            'komentar' => 'Komentar',
        ];
    }
}
