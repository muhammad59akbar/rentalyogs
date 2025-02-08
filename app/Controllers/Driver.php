<?php

namespace App\Controllers;

use App\Models\DriverModels;

class Driver extends BaseController
{
    protected $driverModel;
    protected $KembalikanMobil;

    public function __construct()
    {
        $this->driverModel = new DriverModels();
        $this->KembalikanMobil = new PinjamanMobil();
    }
    public function index(): string
    {
        $this->KembalikanMobil->KembalikanMobil();
        $data = [
            'title' => 'List Driver',
            'listDriver' => $this->driverModel->getDriver()
        ];
        return view('ListDriver', $data);
    }

    public function detailDriver($url): string
    {
        $data = [
            'title' => 'Detail Driver',
            'ddriver' => $this->driverModel->getDriver($url),
            'errors' => \Config\Services::validation()
        ];
        return view('DetailDriver', $data);
    }

    public function editDriver($id_driver)
    {
        $validationRules = [
            'ndriver' => [
                'rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z0-9\s]+$/]|is_unique[driver_mobil.nama_driver, id_driver,' . $id_driver . ']',
                'errors' => [
                    'required' => 'Nama Driver Wajib diisi',
                    'min_length' => 'Nama Driver Minimal 3 Karakter',
                    'is_unique' => 'Silahkan Masukan Nama Yang Lain !!!'

                ]
            ],
            'notelp' => [
                'rules' => 'required|max_length[15]|numeric',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi',
                    'numeric' => 'No Telp hanya di awali 08'
                ]
            ],
            'nikdriver' => [
                'rules' => 'required|max_length[15]|numeric',
                'errors' => [
                    'required' => 'NIK Wajib Diisi',
                    'numeric' => 'NIK berisi Angka !!!'
                ]
            ],
        ];
        if (!$this->validate($validationRules)) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $namadriver = $this->request->getPost('ndriver');
        $data = [
            'id_driver' => $id_driver,
            'nama_driver' => $namadriver,
            'no_telp' => $this->request->getPost('notelp'),
            'nik_driver' => $this->request->getPost('nikdriver'),

        ];
        $this->driverModel->save($data);
        $url_driver =  str_replace(' ', '-', $namadriver);
        return redirect()->to('/DetailDriver/' . $url_driver)->with('message', 'Data Berhasil di ubah !!!');
    }

    public function addDriver()
    {
        $validationRules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z0-9\s]+$/]|is_unique[driver_mobil.nama_driver]',
                'errors' => [
                    'required' => 'Nama Driver Wajib diisi',
                    'min_length' => 'Nama Driver Minimal 3 Karakter',
                    'is_unique' => 'Silahkan Masukan Nama Yang Lain !!!'

                ]
            ],
            'notelp' => [
                'rules' => 'required|max_length[15]|numeric',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi',
                    'numeric' => 'No Telp hanya di awali 08'
                ]
            ],
            'nik' => [
                'rules' => 'required|max_length[15]|numeric',
                'errors' => [
                    'required' => 'NIK Wajib Diisi',
                    'numeric' => 'NIK berisi Angka !!!'
                ]
            ],
        ];
        if (!$this->validate($validationRules)) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_driver' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('notelp'),
            'nik_driver' => $this->request->getPost('nik')
        ];
        $this->driverModel->save($data);
        return redirect()->to('/ListDriver')->with('message', 'Data Mobil Berhasil Ditambahkan !!!');
    }


    public function deleteDriver($id_driver)
    {
        $mobil = $this->driverModel->find($id_driver);
        $this->driverModel->delete($mobil);

        return redirect()->to('/ListDriver')->with('message', 'Data berhasil dihapus !!!');
    }
}
