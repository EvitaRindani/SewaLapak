<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "detail_tanah".
 *
 * @property string $id_detail
 * @property string $tanah_id
 * @property string $tanggal_tersedia
 * @property string $waktu_awal
 * @property string $waktu_akhir
 * @property string $harga
 *
 * @property Tanah $tanah
 * @property Pemesanan[] $pemesanans
 */
class DetailTanah extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'detail_tanah';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tanah_id', 'tanggal_tersedia', 'waktu_awal', 'waktu_akhir', 'harga'], 'required'],
            [['tanah_id'], 'integer'],
            [['tanggal_tersedia', 'waktu_awal', 'waktu_akhir'], 'safe'],
            [['harga'], 'string', 'max' => 255],
            [['tanah_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tanah::className(), 'targetAttribute' => ['tanah_id' => 'id_tanah']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_detail' => 'Id Detail',
            'tanah_id' => 'Id Tanah',
            'tanggal_tersedia' => 'Tanggal yang Tersedia',
            'waktu_awal' => 'Waktu Mulai',
            'waktu_akhir' => 'Waktu Selesai',
            'harga' => 'Harga (Rp)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTanah() {
        return $this->hasOne(Tanah::className(), ['id_tanah' => 'tanah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemesanans() {
        return $this->hasMany(Pemesanan::className(), ['detail_id' => 'id_detail']);
    }

    public function namaPemilik($id) {
        
    }

}
