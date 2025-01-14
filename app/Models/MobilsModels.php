<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilsModels extends Model
{
    protected $table      = 'mobil_items';
    protected $primaryKey = 'id_mobil';
    protected $useTimestamps = true;
    protected $allowedFields = ['merk_mobil', 'no_plat', 'warna_mobil', 'img_mobil', 'no_stnk', 'status'];

    public function getMobils($url = false)
    {
        if ($url === false) {
            return $this->findAll();
        }

        $nostnk =  $this->where(['no_stnk' => $url])->first();
        if (!$nostnk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Mobil dengan No $nostnk tidak ditemukan.");
        }
        return $nostnk;
    }
}
