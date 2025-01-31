<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Controllers\PinjamanMobil;

class KembalikanFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $kembalikan = new PinjamanMobil();
        $kembalikan->KembalikanMobil();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
