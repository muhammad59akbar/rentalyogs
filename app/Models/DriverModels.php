<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModels extends Model
{
    protected $table      = 'driver_mobil';
    protected $primaryKey = 'id_driver';

    protected $allowedFields = ['nama_driver', 'no_telp',  'nik_driver', 'status'];

    public function getDriver($url = false)
    {
        if ($url === false) {
            return $this->findAll();
        }
        $urlnamedriver = str_replace('-', ' ', $url);
        $namadriver = $this->where(['nama_driver' => $urlnamedriver])->first();

        if (!$namadriver) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Nama Driver $urlnamedriver tidak ditemukan.");
        }
        return $namadriver;
    }
}
