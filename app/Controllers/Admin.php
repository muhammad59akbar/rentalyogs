<?php

namespace App\Controllers;

use App\Models\MobilsModels;
use App\Models\PinjamanModels;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class Admin extends BaseController
{
    protected $userModel;
    protected $groupModel;
    protected $pinjamModel;
    protected $mobilModel;
    protected $KembalikanMobil;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->pinjamModel = new PinjamanModels();
        $this->mobilModel = new MobilsModels();
        $this->KembalikanMobil = new PinjamanMobil();
    }
    public function index(): string
    {
        $this->KembalikanMobil->KembalikanMobil();


        $totalMobil = $this->mobilModel->countAllResults();
        $totalPinjaman = $this->pinjamModel->where('status', 'Belum Dikembalikan')->countAllResults();
        $mobilTersedia = $this->mobilModel->where('status', 'Tersedia')->countAllResults();

        $PinjamanSelesai = $this->pinjamModel->where('status', 'Selesai')->countAllResults();
        $prosesPinjaman =  $this->pinjamModel->getListPinjaman();


        // if (in_groups('Admin')) {

        //     $totalMobil = $this->mobilModel->countAllResults();
        //     $totalPinjaman = $this->pinjamModel->where('status', 'Belum Dikembalikan')->countAllResults();
        //     $mobilTersedia = $this->mobilModel->where('status', 'Tersedia')->countAllResults();

        //     $PinjamanSelesai = $this->pinjamModel->where('status', 'Selesai')->countAllResults();
        //     $prosesPinjaman =  $this->pinjamModel->getListPinjaman();
        // }
        $data = [
            'title' => 'Dashboard',

            'totalMobil' => $totalMobil,
            'mobilTersedia' => $mobilTersedia,
            'prosesPinjaman' => $prosesPinjaman,

            'totalPinjaman' => $totalPinjaman,

            'pinjamanSelesai' => $PinjamanSelesai
        ];
        return view('Dashboard', $data);
    }
    public function listUser(): string
    {
        $data = [
            'title' => 'List User',
            'errors' => \Config\Services::validation(),
            'userrental' => $this->userModel->getUsersWithRoles()

        ];
        return view('ListUser', $data);
    }

    public function AddUser()
    {
        $validationRules = [

            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} Wajib diisi',
                    'is_unique' => '{field} Sudah Ada !!!',
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[5]|max_length[30]|regex_match[/^[a-zA-Z0-9\s]+$/]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => '{field} already registered.'
                ]
            ],
            'password' => 'required',
            'confpass' => 'required|matches[password]',
            'namalengkap' => [
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9\s]+$/]|',
                'errors' => [
                    'required' => 'Nama Wajib diisi',
                    'min_length' => 'Nama Minimal 3 Karakter',
                    'regex_match' => 'Nama Harap Diisi Dengan Benar !!!'
                ]
            ],
            'imgKaryawan' => [
                'rules' => 'max_size[imgKaryawan,1024]|is_image[imgKaryawan]|mime_in[imgKaryawan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'this file very big',
                    'is_image' => 'this is not image',
                    'mime_in' => 'this is not image',

                ]

            ],


        ];
        if (!$this->validate($validationRules)) {

            return redirect()->to('/Admin/ListUser')->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotokaryawan = $this->request->getFile('imgKaryawan');

        if ($fotokaryawan->getError() === 4) {
            $NFotoKaryawan = 'default.webp';
        } else {
            $NFotoKaryawan = $fotokaryawan->getRandomName();
            $fotokaryawan->move('assets/images/karyawan/', $NFotoKaryawan);
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('namalengkap'),
            'password_hash' =>  Password::hash($this->request->getVar('password')),
            'active' => 1,
            'image_name' => $NFotoKaryawan
        ];
        $userID = $this->userModel->insert($data);

        if ($userID) {
            $role = $this->request->getPost('role');
            $this->groupModel->addUserToGroup($userID, $role);
            return redirect()->back()->with('message', 'User berhasil ditambahkan !!!');
        } else {
            return redirect()->back()->with('message', 'Gagal menambahkan user.');
        }
    }

    public function detailUser($url): string
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->GetUserbyURL($url),
            'role' => $this->groupModel->select('id, name')->findAll(),
            'errors' => \Config\Services::validation()

        ];
        return view('DetailUser', $data);
    }


    public function editUser($id_user)
    {
        $validationRules = [
            'email' => [
                'rules' => 'required|is_unique[users.email,  id,' . $id_user . ']',
                'errors' => [
                    'required' => '{field} Wajib diisi',
                    'is_unique' => '{field} Sudah Ada !!!',
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[5]|max_length[30]|regex_match[/^[a-zA-Z0-9\s]+$/]|is_unique[users.username,  id,' . $id_user . ']',
                'errors' => [
                    'is_unique' => '{field} already registered.'
                ]
            ],
            'password' => 'permit_empty|min_length[5]',
            'namalengkap' => [
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9\s]+$/]|',
                'errors' => [
                    'required' => 'Nama Wajib diisi',
                    'min_length' => 'Nama Minimal 3 Karakter',
                    'regex_match' => 'Nama Harap Diisi Dengan Benar !!!'
                ]
            ],
            'imagekaryawan' => [
                'rules' => 'max_size[imagekaryawan,1024]|is_image[imagekaryawan]|mime_in[imagekaryawan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'this file very big',
                    'is_image' => 'this is not image',
                    'mime_in' => 'this is not image',

                ]

            ],
            'role' => 'required'


        ];

        if (!$this->validate($validationRules)) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageKaryawan = $this->request->getFile('imagekaryawan');
        $imageOldKaryawan = $this->request->getPost('fotoOld');

        if ($imageKaryawan->getError() == 4) {
            $nameImage = $imageOldKaryawan;
        } else if ($imageOldKaryawan == 'default.webp') {

            $nameImage =   $imageKaryawan->getRandomName();
            $imageKaryawan->move('assets/images/karyawan/', $nameImage);
        } else {
            $nameImage = $imageKaryawan->getRandomName();
            $imageKaryawan->move('assets/images/karyawan/', $nameImage);
            unlink('assets/images/karyawan/' . $imageOldKaryawan);
        }

        $password = $this->request->getPost('password');
        $checkpassword = $this->userModel->find($id_user);
        $nama_user = $this->request->getPost('namalengkap');
        $url = str_replace(' ', '-', $nama_user);

        if (!empty($password)) {
            $newpassword = Password::hash($password, PASSWORD_BCRYPT);
        } else {
            $newpassword = $checkpassword->password_hash;
        }

        $data = [
            'id' => $id_user,
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'fullname' =>  $nama_user,
            'image_name' => $nameImage,
            'password_hash' =>  $newpassword,
        ];
        // tambahin validasi id di usermodelnya
        $this->userModel->save($data);

        $role = $this->request->getPost('role');
        $this->groupModel->updateUserGroup($id_user, $role);
        \Config\Services::cache()->clean();
        return redirect()->to('Admin/DetailUser/' . $url)->with('message', 'Data pengguna berhasil diubah!');
    }

    public function deleteUser($id_user)
    {
        $user = $this->userModel->find($id_user);
        if ($user) {
            $role = $this->groupModel->getGroupsForUser($id_user);
            foreach ($role as $r) {
                $this->groupModel->removeUserFromGroup($id_user, $r['group_id']);
            }
            if ($user->image_name != 'default.webp') {
                unlink('assets/images/karyawan/' . $user->image_name);
            }
        }
        $this->userModel->delete($id_user, true);

        return redirect()->to('/Admin/ListUser')->with('message', 'Data pengguna berhasil diHapus !!!');
    }
}
