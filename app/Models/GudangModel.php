<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;

class GudangModel extends Model
{
    protected $table            = 'gudang';
    protected $primaryKey       = 'id_gudang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields = ['id_kantor', 'id_kantor_cabang', 'nama_gudang', 'alamat_gudang'];

    // Validation
    protected $validationRules = [
        'id_kantor' => 'required|integer',
        'nama_gudang' => 'required|max_length[255]',
        'alamat_gudang' => 'required',
    ];

    protected $validationMessages = [
        'id_kantor' => [
            'required' => 'ID Kantor harus diisi.',
            'integer' => 'ID Kantor harus berupa angka.',
        ],
        'nama_gudang' => [
            'required' => 'Nama gudang harus diisi.',
            'max_length' => 'Nama gudang tidak boleh lebih dari 255 karakter.',
        ],
        'alamat_gudang' => [
            'required' => 'Alamat gudang harus diisi.',
        ],
    ];

    public function getGudangByKantor($idKantor)
    {
        $query = $this->db->table('gudang')
            ->select('gudang.*, kantor_cabang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = gudang.id_kantor_cabang', 'left')
            ->where('gudang.id_kantor_cabang', $idKantor)
            ->get();
        return $query->getResult();
    }
}
