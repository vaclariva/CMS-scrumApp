<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'tbl_pengguna';

    protected $fillable = [
        'pengguna_name',
        'pengguna_email',
        'pengguna_peran',
    ];

    protected $primaryKey = 'pengguna_id';

    public $incrementing = false;
    protected $keyType = 'string';
}
