<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table      = 'stocks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'item_id',
        'location_id',
        'qty'
    ];
}