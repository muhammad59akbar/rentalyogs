<?php

namespace App\Controllers;

class Driver extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'List Driver'
        ];
        return view('ListDriver', $data);
    }
}
