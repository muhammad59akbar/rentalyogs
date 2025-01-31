<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModels extends Model
{
    protected $table      = 'driver_mobil';
    protected $primaryKey = 'id_driver';

    protected $allowedFields = ['nama_driver', 'notelp',  'nik_driver', 'status'];
}
