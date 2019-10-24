<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tanah".
 *
 * @property string $id_tanah
 * @property string $nama_pemilik
 * @property file $foto_pemilik
 * @property string $no_hp_pemilik
 * @property string $no_rekening_pemilik
 * @property string $alamat_tanah
 * @property file $gambar_tanah
 * @property string $kota
 * @property string $kabupaten
 *
 * @property DetailTanah[] $detailTanahs
 */
class Tanah extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tanah';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nama_pemilik', 'foto_pemilik', 'no_hp_pemilik', 'no_rekening_pemilik', 'alamat_tanah', 'gambar_tanah', 'kota', 'kabupaten'], 'required'],
            [['nama_pemilik', 'no_hp_pemilik', 'no_rekening_pemilik', 'alamat_tanah', 'kota', 'kabupaten'], 'string', 'max' => 255],
            [['foto_pemilik', 'gambar_tanah'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_tanah' => 'Id Lapak',
            'nama_pemilik' => 'Nama Pemilik',
            'foto_pemilik' => 'Foto Pemilik',
            'no_hp_pemilik' => 'Nomor Hp Pemilik',
            'no_rekening_pemilik' => 'Kondisi Tanah',
            'alamat_tanah' => 'Alamat Lapak',
            'gambar_tanah' => 'Gambar Lapak',
            'kota' => 'Ukuran Lapak (m2)',
            'kabupaten' => 'Kota',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailTanahs() {
        return $this->hasMany(DetailTanah::className(), ['tanah_id' => 'id_tanah']);
    }

}
