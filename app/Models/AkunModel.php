<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $returnType       = 'object';
    protected $allowedFields = ['id_kantor', 'id_hak_akses', 'id_gudang', 'username', 'password', 'nama_lengkap'];

    protected $validationRules = [
        'id_hak_akses' => 'required',
        'username' => 'required|is_unique[akun.username]',
        'password' => 'required',
        'nama_lengkap' => 'required',
    ];

    protected $validationMessages = [
        'id_hak_akses' => [
            'required' => 'Hak Akses harus diisi.',
        ],
        'username' => [
            'required' => 'Username harus diisi.',
            'is_unique' => 'Username sudah digunakan.',
        ],
        'password' => [
            'required' => 'Password harus diisi.',
        ],
        'nama_lengkap' => [
            'required' => 'Nama Lengkap harus diisi.',
        ]
    ];

    public function getAll()
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, gudang.*, hak_akses.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor = akun.id_kantor', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->get();
        return $query->getResult();
    }

    public function getAkunByIdAkun($idAkun)
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, hak_akses.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor = akun.id_kantor', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->where('akun.id_akun', $idAkun)
            ->get();
        return $query->getRow();
    }

    public function getAkunByKantor($idKantor)
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, hak_akses.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor = akun.id_kantor', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->where('akun.id_kantor', $idKantor)
            ->get();
        return $query->getResult();
    }

    public function getAkunByKantor2($idKantor)
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, hak_akses.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = akun.id_kantor_cabang', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->where('akun.id_kantor_cabang', $idKantor)
            ->where('akun.id_gudang !=', null)
            ->get();
        return $query->getResult();
    }

    public function getAkunByHakAkses($idHakAkses)
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, hak_akses.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor = akun.id_kantor', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->where('akun.id_hak_akses', $idHakAkses)
            ->get();
        return $query->getResult();
    }

    public function getAkunByHakAksesAndKantor($idHakAkses, $idKantor)
    {
        $query = $this->db->table('akun')
            ->select('akun.*, kantor_cabang.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor = akun.id_kantor', 'left')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->join('gudang', 'gudang.id_gudang = akun.id_gudang', 'left')
            ->where('akun.id_hak_akses', $idHakAkses)
            ->where('akun.id_kantor', $idKantor)
            ->get();
        return $query->getResult();
    }

    public function getAkunByUsernamePassword($username, $password)
    {
        $query = $this->db->table('akun')
            ->select('akun.*,hak_akses.*')
            ->join('hak_akses', 'hak_akses.id_hak_akses = akun.id_hak_akses', 'left')
            ->where('akun.username', $username)
            ->where('akun.password', $password)
            ->get();
        return $query->getRow();
    }
}
