<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('Dashboard', $data);
    }
    public function listUser(): string
    {
        $data = [
            'title' => 'List User',
            'userrental' => $this->userModel->getUsersWithRoles()

        ];
        return view('ListUser', $data);
    }

    public function detailUser($url): string
    {
        $data = [
            'title' => 'Detail User',

        ];
        return view('DetailUser', $data);
    }
}
