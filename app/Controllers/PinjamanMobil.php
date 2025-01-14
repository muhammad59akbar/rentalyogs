<?php

namespace App\Controllers;

use App\Models\MobilsModels;
use App\Models\PinjamanModels;

class PinjamanMobil extends BaseController
{
    protected $MobilModel;
    protected $PinjamanModel;

    public function __construct()
    {
        $this->MobilModel = new MobilsModels();
        $this->PinjamanModel = new PinjamanModels();
    }
    public function index(): string
    {
        $data = [
            'title' => 'List Pinjaman',
            'listpinjaman' => $this->PinjamanModel->getListPinjaman(),

        ];
        return view('ListPinjaman', $data);
    }

    public function PinjamMobil()
    {
        $id_mobil = $this->request->getPost('id_mobil');


        $validationRules = [
            'id_mobil' => [
                'rules' => 'required',
            ],

            'id_user' => [
                'rules' => 'required'
            ],

            'ndriver' => [
                'rules' => 'required'
            ],
            'nikdrive' => [
                'rules' => 'required|numeric'
            ],
            'no_telp' => [
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
            ]


        ];


        if (!$this->validate($validationRules)) {
            session()->setFlashdata('modal', 'pinjam');
            session()->setFlashdata('id_mobil', $id_mobil);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_mobil' => $id_mobil,
            'id_user' => $this->request->getPost('id_user'),
            'nama_driver' => $this->request->getPost('ndriver'),
            'Nik_driver' => $this->request->getPost('nikdrive'),
            'no_telp_driver' => $this->request->getPost('no_telp'),
            'tanggal_pinjaman' => $this->request->getPost('tgl_pjm'),
            'tanggal_kembali' => $this->request->getPost('tgl_kembalikan')
        ];

        $this->PinjamanModel->save($data);
        $newstatus = 'Tidak Tersedia';
        $this->MobilModel->update($id_mobil, ['status' => $newstatus]);
        return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Meminjam Mobil !!!');
    }

    public function KembalikanMobil()
    {
        $id_pinjaman = $this->request->getPost('id_pinjaman');
        $id_user = user_id();

        $validationRules = [
            'id_user' => [
                'rules' => 'required'
            ],
            'id_mobil' => [
                'rules' => 'required'
            ],
            'id_pinjaman' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'harus diisi',
                    'integer' => 'harus angka'
                ]
            ],

        ];

        if (!$this->validate($validationRules)) {
            session()->setFlashdata('id_pinjaman', $id_pinjaman);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $id_mobil = $this->request->getPost('id_mobil');
        if (!in_groups('Admin')) {
            $pinjaman = $this->PinjamanModel->where([
                'id_mobil' => $id_mobil,
                'id_pinjaman' => $id_pinjaman,
                'id_user' => $id_user
            ])->first();

            if (!$pinjaman) {
                return redirect()->back()->withInput()->with('terlarang', 'Pinjaman Anda Gagal Dikembalikan');
            }
        }



        $data = [
            'status' => 'Selesai',
            'id_mobil' => $id_mobil,
            'id_pinjaman' => $id_pinjaman,
            'tanggal_kembali' => date('Y-m-d H:i:s'),
        ];


        $this->PinjamanModel->save($data);
        $newstatus = 'Tersedia';
        $this->MobilModel->update($id_mobil, ['status' => $newstatus]);
        return redirect()->to('/ListPinjaman')->with('message', 'Anda Berhasil Memulangkan Mobil !!!');
    }

    public function detailPinjaman($url_item)
    {
        $data = [
            'title' => 'List Pinjaman',
            'listpinjaman' => $this->PinjamanModel->getListPinjaman($url_item),

        ];
        return view('DetailPinjaman', $data);
    }
}
