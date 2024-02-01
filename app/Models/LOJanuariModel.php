<?php

namespace App\Models;

use CodeIgniter\Model;

class LOJanuariModel extends Model
{
    protected $table            = 'januari_lo';
    protected $primaryKey       = 'id_lo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [];
    
}
