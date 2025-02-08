<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModels extends Model
{
    protected $table      = 'pinjaman_mobils';
    protected $primaryKey = 'id_pinjaman';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_mobil', 'i_driver',  'tanggal_pinjaman', 'tanggal_kembali', 'status', 'approved_by', 'tujuan', 'penjemputan', 'namapeminjam'];


    // public function getListPinjaman($url_item = false)
    // {

    //     $list = $this->select('pinjam_mobils.*, mobil_items.merk_mobil, mobil_items.no_plat, mobil_items.no_stnk, mobil_items.warna_mobil, mobil_items.img_mobil,  users.fullname')
    //         ->join('mobil_items', 'mobil_items.id_mobil = pinjam_mobils.id_mobil');




    //     if ($url_item) {
    //         [$id, $slug] = explode('-', $url_item, 2);
    //         $nama_peminjam = str_replace('-', ' ', $slug);
    //         $id_pinjaman = $list
    //             ->where(['pinjam_mobils.id_pinjaman' => $id])
    //             ->where(['users.fullname' => $nama_peminjam])
    //             ->first();

    //         if (!$id_pinjaman) {
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pinjaman $url_item tidak ditemukan.");
    //         }
    //         return $id_pinjaman;
    //     }
    //     return $list->get()->getResultArray();
    // }

    // public function getListPinjaman($url_item = false)
    // {
    //     $list = $this->select('pinjaman_mobils.*, mobil_items.merk_mobil, mobil_items.no_plat, mobil_items.img_mobil, driver_mobil.nama_driver, driver_mobil.no_telp, driver_mobil.nik_driver')
    //         ->join('mobil_items', 'mobil_items.id_mobil =  pinjaman_mobils.id_mobil', 'left')
    //         ->join('driver_mobil', 'driver_mobil.id_driver =  pinjaman_mobils.i_driver');


    //     if ($url_item) {
    //         // Pecah parameter menjadi id_mobil dan id_driver
    //         [$id_mobil, $id_driver] = explode('-', $url_item, 2);

    //         $id_driver = urldecode($id_driver);

    //         // Tambahkan kondisi WHERE
    //         // $list = $list->where('pinjaman_mobils.id_pinjaman', $id_mobil)
    //         //     ->where('driver_mobil.nama_driver', $id_driver);
    //         $list = $list->where('pinjaman_mobils.id_pinjaman', $id_mobil)
    //             ->where("REPLACE(driver_mobil.nama_driver, ' ', '-')", $id_driver);

    //         $result = $list->get()->getRowArray();
    //         if (empty($result)) {
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pesanan dengan nomor resi $url_item tidak ditemukan.");
    //         }

    //         // Kembalikan hasil jika data ditemukan
    //         return $result;
    //     }

    //     // Return hasil query
    //     return $list->get()->getResultArray();
    // }


    public function getListPinjaman($url_item = false)
    {
        $list = $this->select('pinjaman_mobils.*, mobil_items.merk_mobil, mobil_items.no_plat, mobil_items.img_mobil, driver_mobil.nama_driver, driver_mobil.no_telp, driver_mobil.nik_driver')
            ->join('mobil_items', 'mobil_items.id_mobil = pinjaman_mobils.id_mobil', 'left')
            ->join('driver_mobil', 'driver_mobil.id_driver = pinjaman_mobils.i_driver');

        if ($url_item) {
            $url_parts = explode('-', $url_item, 2);
            $id_pinjaman = $url_parts[0];  // Ambil ID
            $url_peminjam = str_replace('-', ' ', $url_parts[1]);  // Ambil Nama Peminjam

            // Filter berdasarkan ID dan Nama Peminjam
            $list = $list->where('pinjaman_mobils.id_pinjaman', $id_pinjaman)
                ->where('pinjaman_mobils.namapeminjam', $url_peminjam);


            $result = $list->get()->getRowArray();
            if (!$result) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Nama Peminjam $url_peminjam tidak ditemukan.");
            }

            return $result;
        }

        return $list->get()->getResultArray();
    }
}
