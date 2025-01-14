<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModels extends Model
{
    protected $table      = 'pinjam_mobils';
    protected $primaryKey = 'id_pinjaman';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_mobil', 'id_user', 'nama_driver', 'Nik_driver', 'no_telp_driver', 'tanggal_pinjaman', 'tanggal_kembali', 'status'];


    public function getListPinjaman($url_item = false)
    {
        $id_user = user_id();
        $list = $this->select('pinjam_mobils.*, mobil_items.merk_mobil, mobil_items.no_plat, mobil_items.no_stnk, mobil_items.warna_mobil, mobil_items.img_mobil,  users.fullname')
            ->join('mobil_items', 'mobil_items.id_mobil = pinjam_mobils.id_mobil')
            ->join('users', 'users.id = pinjam_mobils.id_user');

        if (in_groups('Admin')) {
        } else {
            $list->where('pinjam_mobils.id_user', $id_user);
        }

        if ($url_item) {
            [$id, $slug] = explode('-', $url_item, 2);
            $nama_peminjam = str_replace('-', ' ', $slug);
            $id_pinjaman = $list
                ->where(['pinjam_mobils.id_pinjaman' => $id])
                ->where(['users.fullname' => $nama_peminjam])
                ->first();

            if (!$id_pinjaman) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pinjaman $url_item tidak ditemukan.");
            }
            return $id_pinjaman;
        }
        return $list->get()->getResultArray();
    }
}
