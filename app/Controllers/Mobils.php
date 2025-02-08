<?php

namespace App\Controllers;

use App\Models\MobilsModels;

class Mobils extends BaseController
{
    protected $MobilModel;
    protected $KembalikanMobil;

    public function __construct()
    {
        $this->MobilModel = new MobilsModels();
        $this->KembalikanMobil = new PinjamanMobil();
    }
    public function index(): string
    {
        $this->KembalikanMobil->KembalikanMobil();
        $data = [
            'title' => 'List Mobil',
            'listMobil' => $this->MobilModel->getMobils(),
            'errors' => \Config\Services::validation()
        ];
        return view('ListMobil', $data);
    }

    public function addnewMobil()
    {
        $validationRules = [
            'merkmobil' => [
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9\s]+$/]',
                'errors' => [
                    'required' => 'Merk Mobil Wajib diisi',
                    'min_length' => 'Merk Mobil Minimal 3 Karakter',
                ]
            ],
            'warnambl'   =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Warna Mobil Wajib Diisi'
                ]
            ],
            'noplat' => [
                'rules' => 'required|is_unique[mobil_items.no_plat]|regex_match[/^(?! )[a-zA-Z0-9\s]+$/]',
                'errors' => [
                    'required' => 'Plat Mobil Wajib Diisi'
                ]
            ],

            'gmbr_mbl' => [
                'rules' => 'max_size[gmbr_mbl,1024]|is_image[gmbr_mbl]|mime_in[gmbr_mbl,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'this file very big',
                    'is_image' => 'this is not image',
                    'mime_in' => 'this is not image',

                ]

            ]
        ];


        if (!$this->validate($validationRules)) {
            session()->setFlashdata('modal', 'mobil');
            return redirect()->to('/ListMobil')->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageMobil = $this->request->getFile('gmbr_mbl');

        if ($imageMobil->getError() === 4) {
            $NImageMobil = 'noimage.webp';
        } else {
            $NImageMobil = $imageMobil->getRandomName();
            $imageMobil->move('assets/images/mobil/', $NImageMobil);
        }

        $data = [
            'merk_mobil' => $this->request->getPost('merkmobil'),
            'no_plat' => $this->request->getPost('noplat'),
            'warna_mobil' => $this->request->getPost('warnambl'),
            'img_mobil' => $NImageMobil

        ];

        $this->MobilModel->save($data);
        return redirect()->to('/ListMobil')->with('message', 'Data Mobil Berhasil Ditambahkan !!!');
    }

    public function detailMobils($url): string
    {
        $data = [
            'title' => 'Detail Mobil',
            'mobil' => $this->MobilModel->getMobils($url),
            'errors' => \Config\Services::validation()

        ];
        return view('DetailMobil', $data);
    }

    public function editdataMobil($id_mobil)
    {
        $validationRules = [
            'merkmobil' => [
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9\s]+$/]',
                'errors' => [
                    'required' => 'Merk Mobil Wajib diisi',
                    'min_length' => 'Merk Mobil Minimal 3 Karakter',
                ]
            ],
            'warnambl'   =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Warna Mobil Wajib Diisi'
                ]
            ],
            'noplat' => [
                'rules' => 'required|regex_match[/^(?! )[a-zA-Z0-9\s]+$/]|is_unique[mobil_items.no_plat, id_mobil,' . $id_mobil . ']',
                'errors' => [
                    'required' => 'Plat Mobil Wajib Diisi'
                ]
            ],

            'gmbr_mbl' => [
                'rules' => 'max_size[gmbr_mbl,1024]|is_image[gmbr_mbl]|mime_in[gmbr_mbl,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'this file very big',
                    'is_image' => 'this is not image',
                    'mime_in' => 'this is not image',

                ]

            ]
        ];


        if (!$this->validate($validationRules)) {


            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $imageMobil = $this->request->getFile('gmbr_mbl');
        $imgMobilOld = $this->request->getPost('gmbrmobillama');


        if ($imageMobil->getError() == 4) {
            $NImageMobil = $imgMobilOld;
        } else if ($imgMobilOld == 'noimage.webp') {
            $NImageMobil = $imageMobil->getRandomName();
            $imageMobil->move('assets/images/mobil/', $NImageMobil);
        } else {
            $NImageMobil = $imageMobil->getRandomName();
            $imageMobil->move('assets/images/mobil/', $NImageMobil);

            unlink('assets/images/mobil/' . $imgMobilOld);
        }

        $noplat = $this->request->getPost('noplat');

        $data = [
            'id_mobil' => $id_mobil,
            'merk_mobil' => $this->request->getPost('merkmobil'),
            'no_plat' =>  $noplat,
            'warna_mobil' => $this->request->getPost('warnambl'),

            'img_mobil' => $NImageMobil

        ];
        $this->MobilModel->save($data);
        $url_title = str_replace(' ', '-', $noplat);
        return redirect()->to('/DetailMobil/' . $url_title)->with('message', 'Data Berhasil di ubah !!!');
    }

    public function deletedataMobil($id_mobil)
    {
        $mobil = $this->MobilModel->find($id_mobil);
        if ($mobil['img_mobil'] != 'noimage.webp') {
            unlink('assets/images/mobil/' . $mobil['img_mobil']);
        }

        $this->MobilModel->delete($mobil);

        return redirect()->to('/ListMobil')->with('message', 'Data berhasil dihapus !!!');
    }
}
