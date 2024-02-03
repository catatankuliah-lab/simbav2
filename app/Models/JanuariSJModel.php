<?php

namespace App\Models;

use CodeIgniter\Model;

class JanuariSJModel extends Model
{
    protected $table            = 'januari_sj';
    protected $primaryKey       = 'id_sj';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pbp', 'nomor_lo', 'jumlah_penyaluran_januari', 'nomor_wo', 'nomor_surat_jalan', 'nomor_do', 'nomor_so_bulog', 'file_surat_jalan', 'path_surat_jalan'];

}
