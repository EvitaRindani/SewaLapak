<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pemesanan".
 *
 * @property string $id_pemesanan
 * @property string $user_id
 * @property string $detail_id
 * @property string $waktu_pemesanan
 * @property string $waktu_penerimaan
 * @property integer $status
 * @property integer $status_bayar
 * @property string $foto_transaksi
 *
 * @property User $user
 * @property DetailTanah $detail
 */
class Pemesanan extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pemesanan';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'detail_id', 'waktu_pemesanan', 'waktu_penerimaan', 'status', 'status_bayar', 'foto_transaksi'], 'required'],
            [['user_id', 'detail_id', 'status', 'status_bayar'], 'integer'],
            [['waktu_pemesanan', 'waktu_penerimaan'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => DetailTanah::className(), 'targetAttribute' => ['detail_id' => 'id_detail']],
            [['foto_transaksi'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_pemesanan' => 'Id Pemesanan',
            'user_id' => 'User ID',
            'detail_id' => 'Detail ID',
            'waktu_pemesanan' => 'Waktu Pemesanan',
            'waktu_penerimaan' => 'Waktu Penerimaan',
            'status' => 'Status',
            'status_bayar' => 'Status Bayar',
            'foto_transaksi' => 'Foto Transaksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetail() {
        return $this->hasOne(DetailTanah::className(), ['id_detail' => 'detail_id']);
    }

    public function changeValueStatus($value) {
        if ($value == 0) {
            return "Sedang Dipesan";
        }if ($value == 1) {
            return "Ditolak";
        }if ($value == 2) {
            return "Diterima";
        }
    }

    public function changeValue($value) {
        if ($value == 0) {
            return "Belum Dibayar";
        }if ($value == 1) {
            return "Dibatalkan";
        }if ($value == 2) {
            return "Dibayar";
        }
    }

}
