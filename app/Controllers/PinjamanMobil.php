<?php

namespace App\Controllers;

use App\Models\DriverModels;
use App\Models\MobilsModels;
use App\Models\PinjamanModels;
use DateTime;

class PinjamanMobil extends BaseController
{
    protected $MobilModel;
    protected $PinjamanModel;
    protected $DriverModel;

    public function __construct()
    {
        $this->MobilModel = new MobilsModels();
        $this->PinjamanModel = new PinjamanModels();
        $this->DriverModel = new DriverModels();
    }
    public function index(): string
    {
        $this->KembalikanMobil();
        // $currentHour = date('H:i');
        // if ($currentHour == '17:14') {

        //     $this->KembalikanMobil();
        // }


        $data = [
            'title' => 'List Pinjaman',
            'listpinjaman' => $this->PinjamanModel->getListPinjaman(),
            'listMobil' => $this->MobilModel->where('status', 'Tersedia')->findAll(),
            'listDriver' => $this->DriverModel->where('status', 'Y')->findAll(),
            'errors' => \Config\Services::validation()

        ];
        return view('ListPinjaman1', $data);
    }

    public function PinjamMobil()
    {

        $validationRules = [
            'n_driver' => [
                'rules' => 'required|numeric',
            ],
            'merkmobil' => [
                'rules' => 'required|numeric'
            ],

            'tgl_pjm' => [
                'rules' => 'required|valid_date|less_than_date[tgl_kembalikan]',
                'errors' => [
                    'required' => 'Tanggal pinjam harus diisi.',
                    'valid_date' => 'Format tanggal pinjam tidak valid.',
                    'less_than_date' => 'Tanggal pinjam harus lebih kecil dari tanggal kembalikan.',
                ]
            ],
            'tgl_kembalikan' => [
                'rules' => 'required|valid_date|greater_than_date[tgl_pjm]',
                'errors' => [
                    'required' => 'Tanggal kembalikan harus diisi.',
                    'valid_date' => 'Format tanggal kembalikan tidak valid.',
                    'greater_than_date' => 'Tanggal kembalikan harus lebih besar dari tanggal pinjam.',
                ],
            ],
            'tujuan' => [
                'rules' => 'required'
            ],
            'jemput' => [
                'rules' => 'required'
            ],
            'npinjam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Peminjam Harus Diisi'
                ]

            ]


        ];


        if (!$this->validate($validationRules)) {
            session()->setFlashdata('modal', 'pinjam');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_mobil = $this->request->getPost('merkmobil');
        $id_driver = $this->request->getPost('n_driver');

        $data = [
            'namapeminjam' => $this->request->getPost('npinjam'),
            'i_driver' =>   $id_driver,
            'id_mobil' => $id_mobil,
            'tanggal_pinjaman' => $this->request->getPost('tgl_pjm'),
            'tanggal_kembali' => $this->request->getPost('tgl_kembalikan'),
            'tujuan' => $this->request->getPost('tujuan'),
            'penjemputan' => $this->request->getPost('jemput'),

        ];



        $this->PinjamanModel->save($data);
        $statusMobil = 'Tidak Tersedia';
        $this->MobilModel->update($id_mobil, ['status' => $statusMobil]);
        $statusDriver = 'N';
        $this->DriverModel->update($id_driver, ['status' => $statusDriver]);

        return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Meminjam Mobil !!!');
    }

    // public function KembalikanMobil()
    // {
    //     $id_pinjaman = $this->request->getPost('id_pinjaman');
    //     $id_user = user_id();

    //     $validationRules = [
    //         'id_user' => [
    //             'rules' => 'required'
    //         ],
    //         'id_mobil' => [
    //             'rules' => 'required'
    //         ],
    //         'id_pinjaman' => [
    //             'rules' => 'required|integer',
    //             'errors' => [
    //                 'required' => 'harus diisi',
    //                 'integer' => 'harus angka'
    //             ]
    //         ],

    //     ];

    //     if (!$this->validate($validationRules)) {
    //         session()->setFlashdata('id_pinjaman', $id_pinjaman);
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }


    //     $id_mobil = $this->request->getPost('id_mobil');
    //     if (!in_groups('Admin')) {
    //         $pinjaman = $this->PinjamanModel->where([
    //             'id_mobil' => $id_mobil,
    //             'id_pinjaman' => $id_pinjaman,
    //             'id_user' => $id_user
    //         ])->first();

    //         if (!$pinjaman) {
    //             return redirect()->back()->withInput()->with('terlarang', 'Pinjaman Anda Gagal Dikembalikan');
    //         }
    //     }



    //     $data = [
    //         'status' => 'Selesai',
    //         'id_mobil' => $id_mobil,
    //         'id_pinjaman' => $id_pinjaman,
    //         'tanggal_kembali' => date('Y-m-d H:i:s'),
    //     ];


    //     $this->PinjamanModel->save($data);
    //     $newstatus = 'Tersedia';
    //     $this->MobilModel->update($id_mobil, ['status' => $newstatus]);
    //     return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Memulangkan Mobil !!!');
    // }


    public function KembalikanMobil()
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');


        $pinjamanData = $this->PinjamanModel
            ->where('tanggal_kembali <=', $currentDate)
            ->findAll();
        foreach ($pinjamanData as $pinjaman) {
            $tanggalKembali = new DateTime($pinjaman['tanggal_kembali']);
            $tanggalPinjaman = $tanggalKembali->format('Y-m-d');


            if ($tanggalPinjaman <= $currentDate) {
                if ($tanggalPinjaman === $currentDate && $currentTime > '19:05' || $tanggalPinjaman < $currentDate) {
                    // if ($pinjaman['approved_by'] === null) {
                    //     $this->PinjamanModel->update($pinjaman['id_pinjaman'], ['status' => 'Dibatalkan']);
                    // } else {
                    //     $this->PinjamanModel->update($pinjaman['id_pinjaman'], ['status' => 'Selesai']);
                    // }
                    $this->PinjamanModel->update($pinjaman['id_pinjaman'], ['status' => 'Selesai']);
                    $this->MobilModel->update($pinjaman['id_mobil'], ['status' => 'Tersedia']);
                    $this->DriverModel->update($pinjaman['i_driver'], ['status' => 'Y']);
                }
            }
        }
    }


    public function ApprovePinjaman()
    {
        $id_pinjaman = $this->request->getPost('no_pinjaman');

        $data = [
            'id_pinjaman' => $id_pinjaman,
            'approved_by' => $this->request->getPost('approve_by'),
            'status' => 'Disetujui'
        ];
        $this->PinjamanModel->save($data);
        return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Menyetujui Pinjaman Mobil ini !!!');
    }

    public function detailPinjaman($url_item)
    {
        $data = [
            'title' => 'List Pinjaman',
            'listpinjaman' => $this->PinjamanModel->getListPinjaman($url_item),

        ];
        return view('DetailPinjaman', $data);
    }
    public function EditPinjaman()
    {
        $id_pinjaman = $this->request->getPost('id_pinjaman');
        $validationRules = [
            'n_driver' => [
                'rules' => 'required|numeric',
            ],
            'merkmobil' => [
                'rules' => 'required|numeric'
            ],

            'tgl_pnjm' => [
                'rules' => 'required|valid_date|less_than_date[tgl_kmbli]',
                'errors' => [
                    'required' => 'Tanggal pinjam harus diisi.',
                    'valid_date' => 'Format tanggal pinjam tidak valid.',
                    'less_than_date' => 'Tanggal pinjam harus lebih kecil dari tanggal kembalikan.',
                ]
            ],
            'tgl_kmbli' => [
                'rules' => 'required|valid_date|greater_than_date[tgl_pnjm]',
                'errors' => [
                    'required' => 'Tanggal kembalikan harus diisi.',
                    'valid_date' => 'Format tanggal kembalikan tidak valid.',
                    'greater_than_date' => 'Tanggal kembalikan harus lebih besar dari tanggal pinjam.',
                ],
            ],
            'tjuan' => [
                'rules' => 'required'
            ],
            'jmput' => [
                'rules' => 'required'
            ],

        ];


        if (!$this->validate($validationRules)) {


            session()->setFlashdata('modalubah', 'ubahpinjaman');
            session()->setFlashdata('id_pinjaman', $id_pinjaman);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldDriver = $this->request->getPost('old_driver');
        $newDriver = $this->request->getPost('n_driver');

        if ($oldDriver != $newDriver) {

            if (!empty($oldDriver)) {
                $this->PinjamanModel->update($id_pinjaman, ['i_driver' => $newDriver]);
                $this->DriverModel->update($oldDriver, ['status' => 'Y']);
            }
            if (!empty($newDriver)) {
                $this->DriverModel->update($newDriver, ['status' => 'N']);
            }
        }
        $oldMobil = $this->request->getPost('old_mobil');
        $newMobil = $this->request->getPost('merkmobil');
        if ($oldMobil != $newMobil) {

            if (!empty($oldMobil)) {
                $this->PinjamanModel->update($id_pinjaman, ['id_mobil' => $newMobil]);
                $this->MobilModel->update($oldMobil, ['status' => 'Tersedia']);
            }

            // Set status N untuk mobil baru
            if (!empty($newMobil)) {
                $this->MobilModel->update($newMobil, ['status' => 'Belum Dikembalikan']);
            }
        }

        $data = [
            'id_pinjaman' => $id_pinjaman,
            'tanggal_pinjaman' => $this->request->getPost('tgl_pnjm'),
            'tanggal_kembali' => $this->request->getPost('tgl_kmbli'),
            'tujuan' => $this->request->getPost('tjuan'),
            'penjemputan' => $this->request->getPost('jmput'),

        ];
        $this->PinjamanModel->save($data);
        return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Mengubah Pinjaman !!!');
    }

    public function suratJalan($url_item)
    {
        $listpinjaman = $this->PinjamanModel->getListPinjaman($url_item);

        $data = [
            'title' => 'List Pinjaman',
            'listpinjaman' =>  $listpinjaman,

        ];
        return view('SuratJalan', $data);
    }

    public function deletePinjaman($id_pinjaman)
    {
        $pinjaman = $this->PinjamanModel->find($id_pinjaman);

        $id_mobil = $pinjaman['id_mobil'];
        $this->MobilModel->update($id_mobil, ['status' => 'Tersedia']);

        $id_driver = $pinjaman['i_driver'];
        $this->DriverModel->update($id_driver, ['status' => 'Y']);

        $this->PinjamanModel->delete($pinjaman);
        return redirect()->to('/ListPinjaman')->with('message', 'Data berhasil dihapus !!!');
    }
}
