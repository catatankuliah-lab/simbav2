<?php

namespace App\Models;

use CodeIgniter\Model;

class AlokasiModel extends Model
{
    protected $table            = 'alokasi';
    protected $primaryKey       = 'id_alokasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_alokasi'];
}
