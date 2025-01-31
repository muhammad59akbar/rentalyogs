<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilsModels extends Model
{
    protected $table      = 'mobil_items';
    protected $primaryKey = 'id_mobil';
    protected $useTimestamps = true;
    protected $allowedFields = ['merk_mobil', 'no_plat', 'warna_mobil', 'img_mobil', 'status'];

    public function getMobils($url = false)
    {
        if ($url === false) {
            return $this->findAll();
        }

        $url_no_plat = str_replace('-', ' ', $url);




        $noplat = $this->where(['no_plat' => $url_no_plat])->first();








        if (!$noplat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Mobil dengan No $url_no_plat tidak ditemukan.");
        }
        return $noplat;
    }
}
